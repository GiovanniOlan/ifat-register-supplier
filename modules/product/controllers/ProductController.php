<?php

namespace app\modules\product\controllers;

use Yii;
use app\models\User;
use app\models\CatLine;
use app\models\Product;
use yii\web\Controller;
use app\models\Supplier;
use app\models\MatrizDam;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;
use app\models\ProductImage;
use app\models\CatLineAssignment;
use yii\web\NotFoundHttpException;


class ProductController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex($id)
    {

        $products = Product::find()->where(['pro_fkuser' => $id])->all();


        $craftTypes = [
            1 => 'Artesanía',
            2 => 'Híbrido',
            3 => 'Manualidad',
        ];
        $productLineAssignments = [];
        foreach ($products as $product) {

            $lineAssignments = CatLineAssignment::find()->where(['clias_fkproduct' => $product->pro_id])->all();
            $productLineAssignments[$product->pro_id] = $lineAssignments;
        }
        $lineTypes = CatLine::find()->all();

        $hasProducts = !empty($products);

        $supplier = Supplier::findOne(['sup_fkuser' => $id]);
        if ($supplier && $supplier->sup_finished == 2) {

            return $this->redirect(['/supplier/status/index', 'id' => $id]);
        }

        if (Yii::$app->request->post('finalize_registration')) {

            $supplier = Supplier::findOne(['sup_fkuser' => $id]);

            if ($supplier) {

                $supplier->sup_finished = 2;


                $supplier->save();

                Yii::$app->session->setFlash('success', '¡El registro se ha finalizado correctamente!');
                return $this->redirect(['/supplier/search']);
            } else {
                Yii::$app->session->setFlash('error', 'Proveedor no encontrado para este usuario.');
            }

            // Redirigir a la misma página para evitar envío de formulario repetido
            return $this->refresh();
        }


        return $this->render('index', [
            'id' => $id,
            'products' => $products,
            'craftTypes' => $craftTypes,
            'productLineAssignments' => $productLineAssignments,
            'lineTypes' => $lineTypes,
            'hasProducts' => $hasProducts,
        ]);
    }

    public function actionCreate($id)
    {
        $user = User::findOne($id);
        if (!$user) {
            throw new NotFoundHttpException('El usuario no se encontró.');
        }
        $supplier = Supplier::findOne(['sup_fkuser' => $id]);
        if ($supplier && $supplier->sup_finished == 2) {

            return $this->redirect(['/supplier/status/index', 'id' => $id]);
        }

        $product = new Product();
        $productLineAssignment = new CatLineAssignment(); // asignación de línea
        $productImage = new ProductImage(); // imagebes'
        $matrizDamModel = new MatrizDam();

        $lineOptions = CatLine::find()->select(['clin_name', 'clin_id'])->indexBy('clin_id')->column();
        $uploadPath = Yii::getAlias('@web/upload/images/');
        if (!is_dir($uploadPath)) {
            FileHelper::createDirectory($uploadPath);
        }
        if (Yii::$app->request->isPost) {
            // Cargar los datos del formulario y el modelo de producto
            $data = Yii::$app->request->post();

            $product->load($data);

            // Obtener las imágenes cargadas
            $productImages = UploadedFile::getInstances($product, 'productImages');

            // Procesar las imágenes
            foreach ($productImages as $image) {
                // Guardar la imagen en el servidor
                $imagePath = Yii::getAlias('@app/web/upload/images/') . $data['productImages'][0];

                $image->saveAs($imagePath);

                // Guardar la ruta de la imagen en la base de datos
                $productImage = new ProductImage();
                $productImage->proima_path = $imagePath;
                $productImage->proima_fkproduct = $product->pro_id;
                $productImage->save();
            }
            $productLineAssignment->load($data);
            $matrizDamModel->load($data['Product'], '');

            //  pro_is_craft
            $totalPoints = $this->calculateTotalPoints($data); //  puntos 
            $product->pro_points = $totalPoints;

            if ($totalPoints >= 280 && $totalPoints <= 420) {
                $product->pro_is_craft = 1; // Artesanía
            } elseif ($totalPoints >= 221 && $totalPoints <= 279) {
                $product->pro_is_craft = 2; // Híbrido
            } elseif ($totalPoints <= 100 && $totalPoints <= 220) {
                $product->pro_is_craft = 3; // Manualidad
            }

            $product->pro_fkuser = $id;

            if ($product->save()) {
                $productLineAssignment->clias_fkproduct = $product->pro_id;

                if ($productLineAssignment->save()) {

                    if ($matrizDamModel->save()) {
                        $matrizDamId = $matrizDamModel->mdam_id;

                        $product->pro_fkmdam = $matrizDamId;

                        if ($product->save()) {
                            // Guardar la imagen
                            $productImage->eventImage = UploadedFile::getInstance($productImage, 'eventImage');
                            if ($productImage->eventImage) {
                                if ($productImage->upload()) {
                                    Yii::$app->session->setFlash('success', 'Imagen cargada exitosamente.');
                                } else {
                                    Yii::$app->session->setFlash('error', 'Error al cargar la imagen.');
                                }
                            }
                            return $this->redirect(['/product/index', 'id' => $id]);
                        }
                    }
                }
            }
        }


        return $this->render('_form', [
            'id' => $id,
            'product' => $product,
            'productLineAssignment' => $productLineAssignment,
            'productImage' => $productImage,
            'lineOptions' => $lineOptions,
        ]);
    }
    public function actionUploadImage()
    {
        $product_id = Yii::$app->request->post('product_id');
        $uploadedFiles = UploadedFile::getInstancesByName('productImages');

        foreach ($uploadedFiles as $file) {
            $fileName = 'product_' . $product_id . '_' . Yii::$app->security->generateRandomString(10) . '.' . $file->extension;
            $filePath = Yii::getAlias('@web/upload/images/') . $fileName;
            if ($file->saveAs($filePath)) {
                $productImage = new ProductImage();
                $productImage->proima_path = $filePath;
                $productImage->proima_fkproduct = $product_id;
                $productImage->save();
            } else {
                Yii::error('Error al guardar la imagen: ' . $file->error);
            }
        }

        return true; // Opcional: puedes devolver algún mensaje de éxito si lo deseas
    }


    private function calculateTotalPoints($data)
    {
        //calcular los puntos totales del cuestionario
        $totalPoints = 0;
        // Sumar los puntos de las respuestas del cuestionario
        foreach ($data['Product'] as $question => $answer) {
            if (strpos($question, 'mdam_question') === 0) {
                $totalPoints += $this->calculatePointsForAnswer($answer);
            }
        }
        return $totalPoints;
    }

    private function calculatePointsForAnswer($answer)
    {
        // Respujestas
        switch ($answer) {
            case 'answer1_a':
                return 28;
            case 'answer1_b':
                return 21;
            case 'answer1_c':
                return 14;
            case 'answer2_a':
                return 12;
            case 'answer2_b':
                return 9;
            case 'answer2_c':
                return 6;
            case 'answer2_d':
                return 3;
            case 'answer3_a':
                return 40;
            case 'answer3_b':
                return 30;
            case 'answer3_c':
                return 20;
            case 'answer3_d':
                return 10;
            case 'answer4_a':
                return 52;
            case 'answer4_b':
                return 39;
            case 'answer4_c':
                return 26;
            case 'answer4_d':
                return 13;
            case 'answer5_a':
                return 24;
            case 'answer5_c':
                return 12;
            case 'answer5_d':
                return 6;
            case 'answer6_a':
                return 32;
            case 'answer6_b':
                return 24;
            case 'answer6_c':
                return 16;
            case 'answer6_d':
                return 8;
            case 'answer7_a':
                return 80;
            case 'answer7_b':
                return 60;
            case 'answer7_c':
                return 40;
            case 'answer7_d':
                return 20;
            case 'answer8_a':
                return 80;
            case 'answer8_b':
                return 60;
            case 'answer8_c':
                return 40;
            case 'answer8_d ':
                return 20;
            case 'answer9_a':
                return 8;
            case 'answer9_b':
                return 6;
            case 'answer9_c':
                return 4;
            case 'answer9_d':
                return 2;
            case 'answer10_a':
                return 8;
            case 'answer10_b':
                return 6;
            case 'answer10_c':
                return 4;
            case 'answer10_d':
                return 2;
            case 'answer11_a':
                return 36;
            case 'answer11_b':
                return 27;
            case 'answer11_c':
                return 18;
            case 'answer11_d':
                return 9;
            case 'answer12_a':
                return 20;
            case 'answer12_b':
                return 0;
            default:
                return 0;
        }
    }
}
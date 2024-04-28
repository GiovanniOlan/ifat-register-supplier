<?php

namespace app\modules\product\controllers;

use Yii;
use app\models\User;
use yii\helpers\Url;
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
        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post();

            $product->load($data);

            $productLineAssignment->load($data);
            $matrizDamModel->load($data['Product'], '');
            $productImage->load($data, '');

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
            $productImage->eventImage = UploadedFile::getInstanceByName('ProductImage[eventImage]');

            $product->pro_fkuser = $id;

            if ($product->save()) {
                $productLineAssignment->clias_fkproduct = $product->pro_id;

                if ($productLineAssignment->save()) {

                    if ($matrizDamModel->save()) {
                        $matrizDamId = $matrizDamModel->mdam_id;

                        $product->pro_fkmdam = $matrizDamId;

                        if ($product->save()) {

                            if ($productImage->eventImage !== null) {
                                $tempFilePath = $productImage->eventImage->tempName;
                                $fileMimeType = FileHelper::getMimeType($tempFilePath);

                                if ($fileMimeType === 'image/png' || $fileMimeType === 'image/jpeg') {
                                    $fileName = $productImage->eventImage->name;
                                    $destinationPath = Yii::getAlias('@app/web/upload/images/products/') . $fileName;


                                    if ($productImage->eventImage->saveAs($destinationPath)) {
                                        $productImageModel = new ProductImage();
                                        $productImageModel->proima_path = '@web/upload/images/products/' . $fileName;
                                        $productImageModel->proima_fkproduct = $product->pro_id;
                                        // Guardar el modelo en la base de datos
                                        if ($productImageModel->save()) {
                                        } else {
                                            echo 'Hubo un error al guardar el modelo en la base de datos';
                                        }
                                    } else {
                                        echo 'Hubo un error al mover el archivo';
                                    }
                                } else {
                                    echo 'El tipo de archivo no es compatible. Solo se permiten archivos PNG y JPEG.';
                                }
                            }

                            return $this->redirect(['/product/index', 'id' => $id]);
                        } else {
                            // Hubo un error al guardar el producto en la base de datos
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

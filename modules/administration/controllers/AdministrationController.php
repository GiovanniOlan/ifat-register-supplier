<?php

namespace app\modules\administration\controllers;

use Yii;
use Mpdf\Mpdf;
use yii\db\Query;
use Dompdf\Dompdf;
use Dompdf\Option;
use Dompdf\Options;
use app\models\User;
use kartik\mpdf\Pdf;
use app\models\Message;
use app\models\Product;
use yii\web\Controller;
use app\models\Supplier;
use app\models\ProductImage;
use yii\httpclient\Response;
use app\models\CatLineAssignment;

/**
 * Default controller for the `administration` module
 */
class AdministrationController extends Controller
{
    public $layout = "@app/views/layouts2/main";
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {

        // Consulta para obtener el número de proveedores registrados hoy
        $countSuppliersToday = (new Query())
            ->select('COUNT(*)')
            ->from('supplier')
            ->where(['DATE(created_at)' => date('Y-m-d')])
            ->scalar();

        // Consulta para obtener el número total de proveedores registrados
        $countTotalSuppliers = (new Query())
            ->select('COUNT(*)')
            ->from('supplier')
            ->scalar();

        // Consulta para obtener el número total de Productos registrados
        $countTotalProduct = (new Query())
            ->select('COUNT(*)')
            ->from('product')
            ->scalar();

        // Consulta para obtener el número de proveedores con sup_status igual a 1
        $countActiveSuppliers = (new Query())
            ->select('COUNT(*)')
            ->from('supplier')
            ->where(['sup_status' => 1])
            ->scalar();

        return $this->render('index', [
            'countSuppliersToday' => $countSuppliersToday,
            'countTotalSuppliers' => $countTotalSuppliers,
            'countTotalProduct' => $countTotalProduct,
            'countActiveSuppliers' => $countActiveSuppliers,
        ]);
    }
    public function actionCount()
    {

        // Consulta para obtener el número de proveedores registrados hoy
        $countSuppliersToday = (new Query())
            ->select('COUNT(*)')
            ->from('supplier')
            ->where(['DATE(created_at)' => date('Y-m-d')])
            ->scalar();

        // Consulta para obtener el número total de proveedores registrados
        $countTotalSuppliers = (new Query())
            ->select('COUNT(*)')
            ->from('supplier')
            ->scalar();

        // Consulta para obtener el número total de Productos registrados
        $countTotalProduct = (new Query())
            ->select('COUNT(*)')
            ->from('product')
            ->scalar();

        // Consulta para obtener el número de proveedores con sup_status igual a 1
        $countActiveSuppliers = (new Query())
            ->select('COUNT(*)')
            ->from('supplier')
            ->where(['sup_status' => 1])
            ->scalar();

        return $this->render('index', [
            'countSuppliersToday' => $countSuppliersToday,
            'countTotalSuppliers' => $countTotalSuppliers,
            'countTotalProduct' => $countTotalProduct,
            'countActiveSuppliers' => $countActiveSuppliers,
        ]);
    }
    public function actionProducts()
    {
        // Obtener todos los usuarios registrados
        $users = User::find()
            ->joinWith('suppliers') // Realiza un join con la tabla suppliers
            ->where(['supplier.sup_finished' => 2]) // Aplica el filtro
            ->all();

        // Consulta para obtener el número de proveedores registrados hoy
        $countSuppliersToday = (new Query())
            ->select('COUNT(*)')
            ->from('supplier')
            ->where(['DATE(created_at)' => date('Y-m-d')])
            ->scalar();

        // Consulta para obtener el número total de proveedores registrados
        $countTotalSuppliers = (new Query())
            ->select('COUNT(*)')
            ->from('supplier')
            ->scalar();

        // Consulta para obtener el número total de Productos registrados
        $countTotalProduct = (new Query())
            ->select('COUNT(*)')
            ->from('product')
            ->scalar();

        // Consulta para obtener el número de proveedores con sup_status igual a 1
        $countActiveSuppliers = (new Query())
            ->select('COUNT(*)')
            ->from('supplier')
            ->where(['sup_status' => 1])
            ->scalar();


        return $this->render('products', [
            'users' => $users,
            'countSuppliersToday' => $countSuppliersToday,
            'countTotalSuppliers' => $countTotalSuppliers,
            'countTotalProduct' => $countTotalProduct,
            'countActiveSuppliers' => $countActiveSuppliers,
        ]);
    }

    public function actionUpdateSupplierStatus()
    {
        // Yii::$app->response->format = Response::FORMAT_JSON;

        $request = Yii::$app->request;
        $userId = $request->post('userId');
        $status = $request->post('status');

        $user = User::findOne($userId);
        if ($user) {
            $supplier = $user->suppliers[0] ?? null;
            if ($supplier) {
                $supplier->sup_status = $status;
                if ($supplier->save()) {
                    return ['success' => true];
                }
            }
        }

        return ['success' => false];
    }
    public function actionDetails($id)
    {
        // Buscar el usuario por su ID y cargar las relaciones con Supplier, Person y Address
        $user = User::find()->with('suppliers', 'person', 'addresses', 'products')->where(['id' => $id])->one();

        if (!$user) {
            throw new \yii\web\NotFoundHttpException('El usuario no fue encontrado.');
        }

        // Obtener el modelo de proveedor directamente del usuario
        $supplier = $user->suppliers;

        // Si se envió un formulario para cambiar el estado del proveedor
        $messageModel = new Message();

        // Cargar los modelos relacionados (person, address, y products)
        $person = $user->person;
        $address = $user->addresses;
        $products = $user->products;

        foreach ($products as $product) {
            $product->matrizDam; // Cargar la relación
            $productImages = $product->productImages;
            $firstProductImage = !empty($productImages) ? $productImages[0] : null;
            $catLineAssignments = $product->catLineAssignments;
        }

        // Verificar si se reciben datos del formulario de rechazo
        if ($messageModel->load(Yii::$app->request->post()) && $messageModel->validate()) {
            // Procesar los datos del formulario de rechazo
            $messageModel->save(); // Guardar el motivo de rechazo en la tabla 'message'

            // Encontrar el proveedor
            $supplier = Supplier::findOne(['sup_fkuser' => $id]);

            if ($supplier) {
                $supplier->sup_status = 3; // Establecer el estado del proveedor como "Rechazado"
                $supplier->sup_fkmessage = $messageModel->mess_id; // Asignar el ID del mensaje creado al proveedor
                $supplier->save(); // Guardar los cambios en la tabla 'supplier'
            }

            // Redirigir a una página de confirmación o a donde sea necesario
            return $this->redirect(['confirmation-page']);
        }

        // --------------------------------------------------------------
        // Consultas para obtener estadísticas
        $countSuppliersToday = Supplier::find()->where(['DATE(created_at)' => date('Y-m-d')])->count();
        $countTotalSuppliers = Supplier::find()->count();
        $countTotalProduct = Product::find()->count();
        $countActiveSuppliers = Supplier::find()->where(['sup_status' => 1])->count();

        return $this->render('user_details', [
            'user' => $user,
            'id' => $id,
            'countSuppliersToday' => $countSuppliersToday,
            'countTotalSuppliers' => $countTotalSuppliers,
            'countTotalProduct' => $countTotalProduct,
            'countActiveSuppliers' => $countActiveSuppliers,
            'person' => $person,
            'address' => $address,
            'messageModel' => $messageModel,
            'supplier' => $supplier, // Pasar el modelo de proveedor a la vista
            'products' => $products,
            'firstProductImage' => $firstProductImage,
            'catLineAssignments' => $catLineAssignments,
        ]);
    }

    public function actionSaveRejection($userId, $messageModel)
    {
        var_dump($messageModel);
        // Buscar el usuario por su ID
        $user = User::findOne($userId);
        if (!$user) {
            throw new \yii\web\NotFoundHttpException('El usuario no fue encontrado.');
        }

        // Crear una nueva instancia de Message
        $messageModel = new Message();

        // Verificar si se reciben datos del formulario de rechazo
        if ($messageModel->load(Yii::$app->request->post()) && $messageModel->validate()) {
            // Procesar los datos del formulario de rechazo
            // Por ejemplo, guardar el motivo de rechazo en la base de datos y actualizar el estado del proveedor
            $messageModel->save(); // Guardar el motivo de rechazo en la tabla 'message'
            $supplier = $user->supplier; // Obtener el proveedor asociado al usuario
            if ($supplier) {
                $supplier->sup_status = 3; // Establecer el estado del proveedor como "Rechazado"
                $supplier->sup_fkmessage = $messageModel->mess_id; // Asignar el ID del mensaje creado al proveedor
                $supplier->save(); // Guardar los cambios en la tabla 'supplier'
            }

            // Redirigir a una página de confirmación o a donde sea necesario
            return $this->redirect(['confirmation-page']);
        }

        // Si no se reciben datos del formulario, renderizar la vista del formulario de rechazo
        return $this->render('rejection-form', [
            'user' => $user,
            'messageModel' => $messageModel,
        ]);
    }
    public function actionSaveSupplier($id)
    {
        // Buscar el proveedor por su ID
        $supplier = Supplier::findOne(['sup_fkuser' => $id]);
        if (!$supplier) {
            throw new \yii\web\NotFoundHttpException('El proveedor no fue encontrado.');
        }

        // Crear una instancia del modelo Message
        $messageModel = new Message();
        echo '<pre>';
        var_dump(Yii::$app->request->post());
        echo '</pre>';
        die;
        // Verificar si se reciben datos del formulario
        if ($messageModel->load(Yii::$app->request->post()) && $messageModel->validate()) {
            // Guardar el motivo de rechazo en la tabla 'message'
            $messageModel->save();

            // Actualizar el estado y el mensaje asociado en el modelo Supplier
            $supplier->sup_status = 3; // Establecer el estado del proveedor como "Rechazado"
            $supplier->sup_fkmessage = $messageModel->mess_id; // Asignar el ID del mensaje creado al proveedor
            $supplier->save();

            // Redirigir a una página de confirmación o a donde sea necesario
            return $this->redirect(['confirmation-page']);
        }

        // Si no se reciben datos del formulario, redirigir a la página de detalles del proveedor
        return $this->redirect(['details', 'id' => $id]);
    }


    public function actionDownloadPdf($id)

    {
        // Encuentra el producto por su ID y carga las relaciones necesarias
        $product = Product::find()->with('productImages', 'catLineAssignments')->where(['pro_id' => $id])->one();

        if (!$product) {
            throw new \yii\web\NotFoundHttpException('El producto no fue encontrado.');
        }
        // return $this->render('product_pdf', [
        //     'product' => $product,
        // ]);
        // Renderiza la vista en HTML
        $content = $this->renderPartial('product_pdf', [
            // return $this->render('product_pdf', [
            'product' => $product,
        ]);

        // Configura Dompdf
        $options = new Options();
        $options->set('isRemoteEnabled', TRUE);

        $dompdf = new Dompdf($options);
        $dompdf->setPaper('A4', 'landscape');

        $dompdf->loadHtml($content);

        // Renderiza el PDF
        $dompdf->render();

        // Envía el PDF al navegador para descargarlo
        $dompdf->stream("producto_{$id}.pdf", ['Attachment' => false]);
    }
}

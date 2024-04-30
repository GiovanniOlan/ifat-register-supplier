<?php

namespace app\modules\administration\controllers;

use Yii;
use yii\db\Query;
use Dompdf\Dompdf;
use Dompdf\Options;
use app\models\User;
use app\models\Message;
use app\models\Product;
use yii\web\Controller;
use app\models\Supplier;
use yii\httpclient\Response;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;

/**
 * Default controller for the `administration` module
 */
class AdministrationController extends Controller
{
    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        // 'actions' => ['all', 'pdf'],
                        'roles' => ['@'],
                    ],
                ],
            ],
            // 'verbs' => [
            //     'class' => VerbFilter::class,
            //     'actions' => [
            //         'make-no-editable' => ['post'],
            //         'cancel' => ['post'],
            //         'accept' => ['post'],
            //     ],
            // ],
            // 'ajax' => [
            //     'class' => AjaxFilter::class,
            //     'only' => ['make-no-editable', 'cancel', 'accept'],
            // ],
        ]);
    }
    public $layout = "@app/views/layouts2/main";
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndexOrig()
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

        return $this->render('index_orig', [
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

    public function actionIndex()
    {
        // Obtener todos los usuarios registrados
        $users = User::find()
            ->joinWith('suppliers')
            ->where(['supplier.sup_finished' => 2])
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


        return $this->render('index', [
            'users' => $users,
            'countSuppliersToday' => $countSuppliersToday,
            'countTotalSuppliers' => $countTotalSuppliers,
            'countTotalProduct' => $countTotalProduct,
            'countActiveSuppliers' => $countActiveSuppliers,
        ]);
    }

    public function actionAcceptedCandidates()
    {
        // Obtener todos los usuarios registrados
        $users = User::find()
            ->joinWith('suppliers')
            ->where(['supplier.sup_status' => 2])
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


        return $this->render('accepted_candidates', [
            'users' => $users,
            'countSuppliersToday' => $countSuppliersToday,
            'countTotalSuppliers' => $countTotalSuppliers,
            'countTotalProduct' => $countTotalProduct,
            'countActiveSuppliers' => $countActiveSuppliers,
        ]);
    }

    public function actionRejectedCandidates()
    {
        // Obtener todos los usuarios registrados
        $users = User::find()
            ->joinWith('suppliers')
            ->where(['supplier.sup_status' => 3])
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


        return $this->render('rejected_candidates', [
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

    public function actionRejectSupplier($id)
    {
        // Buscar el proveedor por su ID
        $supplier = Supplier::findOne($id);
        if (!$supplier) {
            throw new \yii\web\NotFoundHttpException('El proveedor no fue encontrado.');
        }

        $messageModel = new Message();
        if ($messageModel->load(Yii::$app->request->post()) && $messageModel->validate()) {
            $messageModel->save();

            $supplier->sup_status = 3;
            $supplier->sup_fkmessage = $messageModel->mess_id;
            $supplier->save();
            return $this->redirect(['details', 'id' => $id]);
        }

        return $this->redirect(['error']);
    }

    public function actionAcceptSupplier($id)
    {
        $supplier = Supplier::findOne($id);
        if (!$supplier) {
            throw new \yii\web\NotFoundHttpException('El proveedor no fue encontrado.');
        }

        $messageModel = new Message();

        if ($messageModel->load(Yii::$app->request->post()) && $messageModel->validate()) {
            $messageModel->save();

            $supplier->sup_status = 2;
            $supplier->sup_fkmessage = $messageModel->mess_id;
            $supplier->save();
            return $this->redirect(['details', 'id' => $id]);
        }

        return $this->redirect(['error']);
    }

    public function actionDownloadPdf($id)
    {
        // Buscar el producto por su ID
        $product = Product::find()->with('productImages', 'catLineAssignments')->where(['pro_id' => $id])->one();

        if (!$product) {
            throw new \yii\web\NotFoundHttpException('El producto no fue encontrado.');
        }

        // Obtener el proveedor asociado al producto
        $supplier = Supplier::find()->where(['sup_fkuser' => $product->pro_fkuser])->one();

        if (!$supplier) {
            throw new \yii\web\NotFoundHttpException('El proveedor no fue encontrado.');
        }

        // Generar el nombre del archivo PDF
        $fileName = $supplier->sup_curp . '_' . $id . '.pdf';

        // Renderizar la vista en HTML
        $content = $this->renderPartial('product_pdf', [
            'product' => $product,
        ]);

        // Configurar Dompdf
        $options = new Options();
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->setPaper('A4', 'landscape');

        $dompdf->loadHtml($content);

        // Renderizar el PDF
        $dompdf->render();

        // Enviar el PDF al navegador para descargarlo
        $dompdf->stream($fileName, ['Attachment' => false]);
    }
}

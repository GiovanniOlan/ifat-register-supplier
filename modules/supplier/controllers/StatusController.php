<?php

namespace app\modules\supplier\controllers;

use app\models\Supplier;
use yii\web\NotFoundHttpException;
use app\controllers\BaseController;
use app\models\Message;

class StatusController extends BaseController
{
    public function actionIndex($id)
    {
        $supplier = Supplier::findOne($id);

        if (!$supplier) {
            throw new \yii\web\NotFoundHttpException('El proveedor no fue encontrado.');
        }
        $rejectedMessage = Message::findOne($supplier->sup_fkmessage);
        $acceptedMessage = Message::findOne(['mess_id' => $supplier->sup_fkmessage]);
        switch ($supplier->sup_status) {
            case 1: // Activo
                return $this->render('pending_view', ['supplier' => $supplier]);
                break;
            case 2: // Pendiente
                return $this->render('accepted_view', ['supplier' => $supplier, 'acceptedMessage' => $acceptedMessage]);
                break;
            case 3: // Rechazado
                return $this->render('rejected_view', ['supplier' => $supplier, 'rejectedMessage' => $rejectedMessage]);
                break;
            default:
                throw new \yii\web\NotFoundHttpException('Estado de proveedor no válido.');
                break;
        }
    }
}

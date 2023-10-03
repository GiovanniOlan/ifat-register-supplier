<?php

namespace app\modules\supplier\controllers;

use Yii;
use app\models\User;
use app\models\Address;
use app\models\Colonia;
use app\controllers\BaseController;

class AddressController extends BaseController
{
    public $modelClass = Address::class;

    public function actionRegister($id)
    {
        $supplier = $this->findModel($id, null, User::class);

        $address = new Address();
        $colonia = Colonia::findOne($address->add_fkcolonia);

        $dataPost = $this->request->post();
        if ($this->request->isPost && $address->load($dataPost)) {
            $address->add_fkuser = $id;
            if (!$address->save()) {
                // TODO: Manejar el error
            }

            return $this->redirect(['index']);
        }

        return $this->render('_form', compact('address', 'colonia'));
    }
}

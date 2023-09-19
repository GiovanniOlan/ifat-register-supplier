<?php

namespace app\modules\supplier\controllers;

use Yii;
use app\models\SupplierForm;
use app\models\Person;
use app\models\Supplier;
use app\models\UserTable;
use app\models\Address;

class SupplierController extends \yii\web\Controller
{

    public function actionRegister()
    {

        $model = new SupplierForm();
        $model->scenario = 'personal';

        $supplier = new Supplier();
        $address = new Address();
        $person = new Person();

        $dataPost = $this->request->post();
        if ($this->request->isPost && $supplier->load($dataPost) && $address->load($dataPost) && $person->load($dataPost)) {
            $transaction = \Yii::$app->db->beginTransaction();
            try {

                if (!$supplier->save()) {
                    throw new \Exception();
                }

                if (!$address->save()) {
                    throw new \Exception();
                }

                if (!$person->save()) {
                    throw new \Exception();
                }

                $transaction->commit();

                // return $this->redirect(['address', 'id' => $user->id]);
                echo '<pre>';
                var_dump('Se guardo');
                echo '</pre>';
                die;
            } catch (\Exception $e) {
                $transaction->rollBack();
            }
        }

        return $this->render('_person', compact('supplier', 'address', 'person'));
    }

    public function actionAddress($id)
    {
        $model = new SupplierForm(['scenario' => 'address']);
        $address = new Address();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $user = UserTable::findOne($id);

            if ($user) {
                $address->add_fkuser = $user->id;
                $address->add_fkcolonia = $model->colonia;
                $address->add_street = $model->street;
                $address->add_exterior = $model->exterior;
                $address->add_interior = $model->interior;
                $address->add_note = $model->note;

                if ($address->save()) {

                    return $this->redirect(['product', 'id' => $id]);
                } else {
                    // Ver si hay errores
                    $errors = $address->getErrors();
                    $errorMessage = 'No se pudo guardar la dirección. Errores: ' . implode(', ', array_map('implode', $errors));
                    Yii::$app->session->setFlash('error', $errorMessage);
                }
            } else {

                Yii::$app->session->setFlash('error', 'Usuario no encontrado.');
            }
        }

        return $this->render('addressForm', [
            'model' => $model,
        ]);
    }

    public function actionList()
    {
        $users = UserTable::find()
            ->with('address', 'person', 'suppliers')
            ->all();

        return $this->render('supplier-list', [
            'users' => $users,
        ]);
    }
}

<?php

namespace app\modules\supplier\controllers;

use Yii;
use app\models\SupplierForm;
use app\models\Person;
use app\models\Supplier;
use app\models\UserTable;
use app\models\Address;

class RegisterSupController extends \yii\web\Controller
{

    public function actionPersonal()
    {

        $model = new SupplierForm();
        $model->scenario = 'personal';

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            //Table user
            $user = new UserTable();
            $user->save();

            //Table Person
            $person = new Person();
            $person->per_fkuser = $user->id;
            $person->per_name = $model->name;
            $person->per_lastname_paternal = $model->lastNamePaternal;
            $person->per_lastname_maternal = $model->lastNameMaternal;
            $person->per_gender = $model->gender;

            //Table supplier
            $supplier = new Supplier();
            $supplier->sup_fkuser = $user->id;
            $supplier->sup_phone = $model->phone;
            $supplier->sup_curp = $model->curp;
            $supplier->sup_rfc = $model->rfc;

            // Verificar si todos los modelos se guardaron 
            if ($user->save() && $person->save() && $supplier->save()) {
                // Enviar a address action
                return $this->redirect(['address', 'id' => $user->id]);
            }
        }

        return $this->render('/register/personalForm', [
            'model' => $model,
        ]);
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

        return $this->render('/register/addressForm', [
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

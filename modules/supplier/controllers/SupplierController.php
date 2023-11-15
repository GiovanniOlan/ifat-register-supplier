<?php

namespace app\modules\supplier\controllers;

use Yii;
use app\models\User;
use app\models\Person;
use app\models\Supplier;
use Da\User\Traits\ContainerAwareTrait;
use app\utils\validators\AjaxRequestModelsValidator;

class SupplierController extends \yii\web\Controller
{
    use ContainerAwareTrait;

    public function actionRegister($rfc)
    {
        $supplierSearch = Supplier::findOne(['sup_rfc' => $rfc]);

        if ($supplierSearch !== null) {
            return $this->redirect(['address/register', 'id' => $supplierSearch->sup_fkuser]);
        }

        $supplier = new Supplier([
            'scenario' => Supplier::SCENARIO_SUPPLIER_REGISTER,
            'sup_rfc' => $rfc,
        ]);
        $person = new Person();
        $user = new User([
            'scenario' => 'create',
        ]);

        $this->make(AjaxRequestModelsValidator::class, [[$supplier, $user]])->validate();

        $dataPost = $this->request->post();
        if ($this->request->isPost && $supplier->load($dataPost) && $person->load($dataPost) && $user->load($dataPost)) {
            $transaction = \Yii::$app->db->beginTransaction();
            try {
                $user->username = $supplier->sup_rfc;
                $user->password = $supplier->sup_rfc;
                if (!$user->save()) {
                    throw new \Exception();
                }

                $person->per_fkuser = $user->id;

                $supplier->loadDefaultValues();
                $supplier->sup_fkuser = $user->id;

                if (!$supplier->save()) {
                    throw new \Exception();
                }

                if (!$person->save()) {
                    throw new \Exception();
                }

                $transaction->commit();

                return $this->redirect(['/supplier/address/register', 'id' => $user->id]);
            } catch (\Exception $e) {
                $transaction->rollBack();
            }
        }

        return $this->render('_form', ['person' => $person, 'supplier' => $supplier, 'user' => $user, 'rfc' => $rfc]);
    }

    public function actionSearch()
    {
        $supplier = new Supplier();

        if (Yii::$app->request->post('Supplier')) {
            $rfc = Yii::$app->request->post('Supplier')['sup_rfc'];

            return $this->redirect(['supplier/register', 'rfc' => $rfc]);
        }

        return $this->render('index', compact('supplier'));
    }
}

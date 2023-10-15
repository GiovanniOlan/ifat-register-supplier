<?php

namespace app\modules\supplier\controllers;

use Yii;
use app\models\User;
use app\models\Address;
use app\models\Colonia;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use app\controllers\BaseController;

class AddressController extends BaseController
{
    public function actionRegister($id)
    {
        $userSupplier = $this->findModel($id, null, User::class);

        if (!empty($userSupplier->addresses)) {
            throw new NotFoundHttpException('Este usuario ya tiene una direccion');
        }

        $address = new Address();

        if (Yii::$app->request->isPost && $address->load(Yii::$app->request->post())) {

            $address->add_fkuser = $userSupplier->id;

            if ($address->save()) {
                return $this->redirect(['site/index']);
            }
        }
        return $this->render('_form', compact('address'));
    }

    /**
     * @param @postal_code Código postal de las colonias al buscar mediante POST.
     *
     * @return array
     */
    public function actionGetColonias()
    {
        $postal_code = Yii::$app->request->post('postal_code');

        $colonias = Colonia::find()
            ->where(['like', 'codigo_postal', $postal_code])
            ->limit(10)
            ->all();

        $colonias = ArrayHelper::map($colonias, 'id', 'nombre');

        return $this->asJson(['success' => true, 'colonias' => $colonias]);
    }
}

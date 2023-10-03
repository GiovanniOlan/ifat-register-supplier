<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class BaseController extends Controller
{
    /**
     * @var ActiveRecord
     */
    public $modelClass;

    protected function renderIsAjax($view, $params = [])
    {
        if (Yii::$app->request->isAjax) {
            return $this->renderAjax($view, $params);
        } else {
            return $this->render($view, $params);
        }
    }

    protected function getHtmlErrors($errors)
    {
        $errorMessages = [];
        foreach ($errors as $attribute => $messages) {
            $errorMessages[] = '<span class="text-danger">' . implode('</span> <hr> <span class="text-danger">', $messages) . '</span>';
        }

        return '<br><br> ' . implode(' <hr> ', $errorMessages);
    }

    protected function findModel($id, $idPjax = null, $modelClass = null)
    {
        if ($modelClass === null) {
            $modelClass = $this->modelClass;
        }

        $msgError = 'Información no encontrada, intente de nuevo.';

        if (($model = $modelClass::findOne($id)) !== null) {
            return $model;
        }

        if (Yii::$app->request->isPjax) {
            return $this->renderAjax('@common/utils/helpers/views/pjax-blank', [
                'pjaxBlock' => true,
                'idPjax' => $idPjax,
                'jsCode' => "showAlertErrorConfirm({
                    text: '{$msgError}',
                });",
            ]);
        }

        if (Yii::$app->request->isAjax) {
            return [
                'success' => false,
                'message' => $msgError,
            ];
        }

        throw new NotFoundHttpException($msgError);
    }
}

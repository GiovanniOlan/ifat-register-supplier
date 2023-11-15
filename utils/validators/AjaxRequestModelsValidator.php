<?php

namespace app\utils\validators;

use Yii;

use yii\base\Model;
use yii\web\Response;
use yii\widgets\ActiveForm;
use InvalidArgumentException;
use Da\User\Contracts\ValidatorInterface;

class AjaxRequestModelsValidator implements ValidatorInterface
{
    protected $models;

    public function __construct(array $models)
    {
        array_walk($models, function ($model) {
            if (!$model instanceof Model) {
                throw new InvalidArgumentException('The array only must be a Models intances.');
            }
        });

        $this->models = $models;
    }

    public function validate()
    {
        $request = Yii::$app->request;

        if ($request->getIsAjax()) {
            $validatedData = [];
            foreach ($this->models as $model) {
                if ($model->load($request->post())) {
                    $errors = ActiveForm::validate($model);
                    if (!empty($errors)) {
                        $validatedData = array_merge($validatedData, $errors);
                    }
                }
            }

            if (!empty($validatedData)) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                Yii::$app->response->data = $validatedData;
                Yii::$app->response->send();
                Yii::$app->end();
                return $validatedData;
            }
        }

        return false;
    }
}

<?php

namespace app\modules\da_custom\controllers;

use yii\filters\AccessControl;
use Da\User\Controller\ProfileController as BaseProfileController;


class ProfileController extends BaseProfileController
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => false,
                        'actions' => ['index'],
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => false,
                        'actions' => ['show'],
                        'roles' => ['?', '@'],
                    ],
                ],
            ],
        ];
    }
}

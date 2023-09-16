<?php

$baseUrl = str_replace('/web', '', (new \yii\web\Request)->getBaseUrl());

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'language' => 'es-ES',
    'name' => 'Registro IFAT',
    'timezone' => 'America/Mexico_City',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'modules' => [
        'supplier' => [
            'class' => 'app\modules\supplier\Module',
        ],
        // 'supplier_register' => [
        //     'class' => 'app\modules\supplier_register\Module',
        // ],
        'user' => [
            'class' => Da\User\Module::class,
            // ...other configs from here: [Configuration Options](installation/configuration-options.md), e.g.
            // 'administrators' => ['admin'], // this is required for accessing administrative actions
            // 'generatePasswords' => true,
            // 'switchIdentitySessionKey' => 'myown_usuario_admin_user_key',
        ]
    ],
    'components' => [
        'authManager' => [
            'class' => \yii\rbac\DbManager::class,
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => $_ENV["COOKIE_VALIDATION_KEY"],
            'baseUrl' => $baseUrl,
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@app/mail',
            // send all mails to a file by default.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'supplier/register/personal' => 'supplier/register-sup/personal',
                'supplier/register/address' => 'supplier/register-sup/address',
                'supplier/list' => 'supplier/register-sup/list',
                // 'supplier/<action:[A-Za-z0-9-]+>' => 'supplier_register/supplier/<action>',
                // 'supplier/<action:[A-Za-z0-9-]+>/<id:\d+>' => 'supplier_register/supplier/<action>',
                // 'supplier/<controller:[A-Za-z0-9-]+>/<action:[A-Za-z0-9-]+>' => 'supplier_register/<controller>/<action>',
                // 'supplier/<controller:[A-Za-z0-9-]+>/<action:[A-Za-z0-9-]+>/<id:\d+>' => 'supplier_register/<controller>/<action>',
                //'supplier/register' => 'supplier_register/supplier/index'
            ],
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => [...explode(',', $_ENV['ALLOWED_IPS']), '127.0.0.1', '::1'],
    ];
}

return $config;

<?php

$config = [
    'bootstrap' => ['log'],

    'components' => [
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'rules' => [
                '<controller>/<action>/<id:\d+>' => '<controller>/<action>',
                '<module>/<controller>/<action>/<id:\d+>' => '<module>/<controller>/<action>',
                '<controller>/<id:\d+>' => '<controller>/view',
            ]
        ],

        /*
        'user' => [
            'class' => 'yii\web\User',
            'identityClass' => 'app\models\User',
        ]
        */
    ],

    'modules' => [

        'api' => [
            'class' => 'app\modules\api\Module',
            'enableErrorCodes' => true,
            'enableLocalization' => true,
            'locales' => ['ru', 'en'],
            'defaultLocale' => 'ru'
        ],

        'admin' => [
            'class' => 'app\modules\admin\Module'
        ]

    ],
];

if (defined('YII_ENV') && YII_ENV == 'dev') {
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs' => ['*'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
}

return $config;

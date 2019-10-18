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
        'request' => [
            'enableCookieValidation' => false,
        ],

        'user' => [
            'class' => 'yii\web\User',
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
            'autoRenewCookie' => true,
        ],
        'media' => [
            'class' => 'ozerich\filestorage\FileStorage',
            'scenarios' => [
                'avatar' => [
                    'storage' => [
                        'type' => 'file',
                        'saveOriginalFilename' => false,
                        'uploadDirPath' => __DIR__ . '/../../web/uploads/images',
                        'uploadDirUrl' => '/uploads/images',
                    ],
                    'validator' => [
                        'maxSize' => 5 * 1024 * 1024,     // 2 MB
                        'checkExtensionByMimeType' => true,
                        'extensions' => ['jpg', 'jpeg', 'bmp', 'gif', 'png']
                    ],
                ],
                'document' => [
                    'storage' => [
                        'type' => 'file',
                        'uploadDirPath' => __DIR__ . '/../../web/uploads/documents',
                        'uploadDirUrl' => '/uploads/documents',
                    ],
                    'validator' => [
                        'maxSize' => 20 * 1024 * 1024,      // 20 MB
                        'checkExtensionByMimeType' => true,
                        'extensions' => ['pdf', 'doc', 'html'],
                    ],
                ]
            ]
        ]

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

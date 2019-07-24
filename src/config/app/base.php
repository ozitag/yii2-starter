<?php

$components = [

    'db' => [
        'class' => 'yii\db\Connection',
        'charset' => 'utf8',
        'dsn' => 'mysql:host=' . getenv('DB_HOST') . ';dbname=' . getenv('DB_NAME'),
        'username' => getenv('DB_USER'),
        'password' => getenv('DB_PASSWORD')
    ],

    'cache' => [
        'class' => 'yii\caching\FileCache',
    ],

    /*
    'i18n' => [
        'translations' => [
            'api_errors' => [
                'class' => 'yii\i18n\PhpMessageSource',
                'sourceLanguage' => 'en',
                'basePath' => '@vendor/blakit/yii2-api/src/messages'
            ],
            '*' => [
                'class' => 'yii\i18n\PhpMessageSource',
                'sourceLanguage' => 'ru-RU',
                'on missingTranslation' => [
                    'blakit\api\errors\TranslationEventHandler',
                    'handleMissingTranslation'
                ]
            ]
        ],
    ],
    */

    'log' => [
        'targets' => [
            [
                'class' => 'yii\log\FileTarget',
                'levels' => ['error'],
                'categories' => ['yii\base\*', 'yii\db\*'],
            ],
        ],
    ]
];

if (getenv('SENTRY_DSN')) {
    $components['sentry'] = [
        'class' => 'mito\sentry\Component',
        'dsn' => getenv('SENTRY_DSN'),
        'environment' => YII_ENV
    ];

    $components['log']['targets'][] = [
        'class' => 'mito\sentry\Target',
        'levels' => ['error', 'warning'],
        'except' => [
            'yii\web\HttpException:401',
            'yii\web\HttpException:404',
            'yii\console\UnknownCommandException',
            'blakit\api\request\InvalidRequestException',
        ],
    ];
}

$config = [
    'id' => 'project',
    'name' => 'project',

    'basePath' => dirname(__DIR__) . '/../',

    'language' => 'ru',
    'sourceLanguage' => 'ru',

    'timezone' => 'Europe/Minsk',

    'components' => $components,

    'params' => [
        'jwt_key' => getenv('JWT_KEY')
    ]
];


return $config;

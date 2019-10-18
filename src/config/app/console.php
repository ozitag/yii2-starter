<?php

$config = [
    'controllerNamespace' => 'app\commands',

    'components' => [

    ],
        'controllerMap' => [
            'migrate' => [
                'class' => 'yii\console\controllers\MigrateController',
                'migrationNamespaces' => [
                    'ozerich\filestorage\migrations',
                ],
            ],
        ],

];

return $config;

<?php
mb_internal_encoding("UTF-8");
date_default_timezone_set('Europe/Moscow');
setlocale(LC_ALL, 'ru_RU');

const APP_NAME = 'web';
const APP_TYPE = 'yii\web\Application';

require(__DIR__ . '/../vendor/autoload.php');
$config = require(__DIR__ . '/../config/init.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');

(new yii\web\Application($config))->run();
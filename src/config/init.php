<?php
(new \Dotenv\Dotenv(__DIR__ . '/env'))->load();

if (!function_exists('__isAssoc__')) {
    function __isAssoc__($arr)
    {
        if (!is_array($arr) || array() === $arr) return false;
        return array_keys($arr) !== range(0, count($arr) - 1);
    }
}

if (!function_exists('__array_merge_recursive_distinct__')) {
    function __array_merge_recursive_distinct__(array &$array1, array &$array2)
    {
        $merged = $array1;
        foreach ($array2 as $key => &$value) {

            if ((__isAssoc__($value) || empty($value)) && (isset($merged[$key]) && __isAssoc__($merged[$key]))) {
                $merged[$key] = __array_merge_recursive_distinct__($merged[$key], $value);
            } else {
                if (isset($array1[$key]) && is_array($array1[$key]) && is_array($array2[$key]) && __isAssoc__($array2[$key])) {
                    $merged[$key] = array_merge_recursive($array1[$key], $array2[$key]);
                } else {
                    $merged[$key] = $value;
                }
            }
        }
        return $merged;
    }
}

if (!function_exists('__mergeConfigs__')) {
    function __mergeConfigs__(...$configs)
    {
        $configs = array_map(function ($file) {
            return is_file($file) ? require($file) : [];
        }, $configs);

        return array_reduce($configs, function ($config, $current) {
            return __array_merge_recursive_distinct__($config, $current);
        }, []);
    }
}

if (!defined('APP_TYPE')) {
    throw new Exception('APP_TYPE is not defined');
}

switch (APP_TYPE) {
    case 'yii\web\Application':
        $app_type = 'web';
        break;
    case 'yii\console\Application':
        $app_type = 'console';
        break;
    default:
        throw new Exception('APP_TYPE must be "yii\web\Application" or "yii\console\Application"');
}

define('YII_ENV', getenv('ENV'));
define('YII_DEBUG', getenv('DEBUG'));

$base_config = __DIR__ . '/app/base.php';
$app_type_config = __DIR__ . '/app/' . $app_type . '.php';

return __mergeConfigs__($base_config, $app_type_config);

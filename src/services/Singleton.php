<?php

namespace app\services;

/**
 * Class Singleton
 * @package app\services
 */
abstract class Singleton
{
    /** @var array $instances */
    private static $instances = array();

    /**
     * @return mixed
     */
    public static function getInstance()
    {
        $class = static::class;
        if (!isset(self::$instances[$class])) {
            self::$instances[$class] = new static();
        }
        return self::$instances[$class];
    }
}
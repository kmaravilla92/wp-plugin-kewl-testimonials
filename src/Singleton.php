<?php

namespace Kewl\Reviews;

use Exception;

class Singleton
{
    private static $instances = [];

    protected function __construct() {}

    protected function __clone() {}

    public function __wakeup() {
        throw new Exception("Cannot unserialize singleton");
    }

    public static function get_instance()
    {
        $subclass = static::class;
        if (!isset(self::$instances[$subclass])) {
            self::$instances[$subclass] = new static();
        }
        return self::$instances[$subclass];
    }
}
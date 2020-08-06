<?php

namespace CoiSA\Singleton;

/**
 * Class AbstractSingleton
 *
 * @package CoiSA\Singleton
 */
abstract class AbstractSingleton implements SingletonInterface
{
    /**
     * @var array<object>
     */
    private static $instance = array();

    /**
     * {@inheritDoc}
     */
    public static function getInstance()
    {
        # PHP 5.3 compatibility
        $className = \get_called_class();

        if (false === \array_key_exists($className, self::$instance)) {
            self::$instance[$className] = $className::newInstance();
        }

        return self::$instance[$className];
    }

    /**
     * Create a new instance of an object.
     *
     * @return mixed
     */
    abstract protected static function newInstance();
}

<?php

/**
 * This file is part of coisa/singleton.
 *
 * This source file is subject to the license that is bundled
 * with this source code in the file LICENSE.
 *
 * @link      https://github.com/coisa/singleton
 * @copyright Copyright (c) 2020 Felipe Sayão Lobato Abreu <github@felipeabreu.com.br>
 * @license   https://opensource.org/licenses/MIT MIT License
 */

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
    private static $instances = array();

    /**
     * Prevent the instance from being cloned.
     *
     * @return void
     */
    protected function __clone()
    {
    }

    /**
     * Prevent from being unserialized.
     *
     * @return void
     */
    protected function __wakeup()
    {
    }

    /**
     * {@inheritDoc}
     */
    final public static function getInstance()
    {
        # PHP 5.3 compatibility
        $className = \get_called_class();

        if (false === \array_key_exists($className, self::$instances)) {
            self::$instances[$className] = $className::newInstance();
        }

        return self::$instances[$className];
    }

    /**
     * Create a new instance of an object.
     *
     * @return mixed
     */
    abstract protected static function newInstance();
}

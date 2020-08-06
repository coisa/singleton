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
 * Trait SingletonTrait
 *
 * @package CoiSA\Singleton
 */
trait SingletonTrait
{
    /**
     * @var static
     */
    private static $instance;

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
        if (null === static::$instance) {
            static::$instance = static::newInstance();
        }

        return static::$instance;
    }

    /**
     * Create a new instance of this object.
     *
     * @return static
     */
    abstract protected static function newInstance();
}

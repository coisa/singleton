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
     * @var object
     */
    protected static $instance;

    /**
     * SingletonTrait constructor.
     */
    final public function __construct()
    {
    }

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
     * @return object
     */
    final public static function getInstance()
    {
        # PHP 5.3 compatibility
        $className = \get_called_class();

        if (null === $className::$instance) {
            $className::$instance = new $className();
        }

        return $className::$instance;
    }
}

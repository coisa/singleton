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
    // @codeCoverageIgnoreStart

    /**
     * Prevent the instance from being cloned.
     *
     * @return void
     */
    final protected function __clone()
    {
    }

    /**
     * Prevent from being serialized.
     *
     * @return void
     */
    final protected function __sleep()
    {
    }

    /**
     * Prevent from being unserialized.
     *
     * @return void
     */
    final protected function __wakeup()
    {
    }

    // @codeCoverageIgnoreEnd

    /**
     * {@inheritDoc}
     */
    final public static function getInstance()
    {
        # PHP 5.3 compatibility
        $className = \get_called_class();

        $arguments = \func_get_args();
        \array_unshift($arguments, $className);

        return \call_user_func_array(array('CoiSA\\Singleton\\Singleton', 'getInstance'), $arguments);
    }
}

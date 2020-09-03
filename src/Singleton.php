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

use CoiSA\Factory\FactoryInterface;
use CoiSA\Factory\StaticFactory;

/**
 * Class Singleton
 *
 * @package CoiSA\Singleton
 */
final class Singleton implements SingletonInterface
{
    /**
     * @var array<object>
     */
    private static $instances = array();

    // @codeCoverageIgnoreStart

    /**
     * Prevent class from being initialized.
     */
    private function __construct()
    {
    }

    // @codeCoverageIgnoreEnd

    /**
     * {@inheritDoc}
     */
    public static function getInstance()
    {
        $arguments = \func_get_args();
        $class     = \array_shift($arguments);
        $instances = self::getInstancesForClass($class);
        $serialize = \serialize($arguments);
        $hash      = \sha1($serialize);

        if (false === \array_key_exists($hash, $instances)) {
            self::setInstanceForClass($class, $hash, $arguments);
        }

        return self::$instances[$class][$hash];
    }

    /**
     * @param string           $class
     * @param FactoryInterface $factory
     */
    public static function setFactory($class, FactoryInterface $factory)
    {
        self::resetInstancesForClass($class);
        StaticFactory::setFactory($class, $factory);
    }

    /**
     * @param string $class
     *
     * @return array<object>
     */
    public static function getInstancesForClass($class)
    {
        if (false === \array_key_exists($class, self::$instances)) {
            self::$instances[$class] = array();
        }

        return self::$instances[$class];
    }

    /**
     * @param string $class
     */
    private static function resetInstancesForClass($class)
    {
        if (\array_key_exists($class, self::$instances)) {
            unset(self::$instances[$class]);
        }
    }

    /**
     * @param string $class
     * @param string $hash
     * @param array  $arguments
     */
    private static function setInstanceForClass($class, $hash, array $arguments)
    {
        \array_unshift($arguments, $class);

        $factory                        = array('CoiSA\\Factory\\StaticFactory', 'create');
        self::$instances[$class][$hash] = \call_user_func_array($factory, $arguments);
    }
}

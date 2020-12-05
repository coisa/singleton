<?php

/**
 * This file is part of coisa/singleton.
 *
 * This source file is subject to the license that is bundled
 * with this source code in the file LICENSE.
 *
 * @link      https://github.com/coisa/singleton
 *
 * @copyright Copyright (c) 2020 Felipe Sayão Lobato Abreu <github@felipeabreu.com.br>
 * @license   https://opensource.org/licenses/MIT MIT License
 */
namespace CoiSA\Singleton\Registry;

use CoiSA\Singleton\Exception\OutOfBoundsException;

/**
 * Class SingletonRegistry.
 *
 * @package CoiSA\Singleton\Registry
 */
final class SingletonRegistry implements SingletonRegistryInterface
{
    /**
     * @var array<object>
     */
    private static $instances = array();

    /**
     * @param string $class
     * @param array  $arguments
     *
     * @return bool
     */
    public static function has($class, array $arguments)
    {
        if (false === \array_key_exists($class, self::$instances)) {
            self::$instances[$class] = array();
        }

        $hash = self::getHash($arguments);

        return \array_key_exists($hash, self::$instances[$class]);
    }

    /**
     * @param string $class
     * @param array  $arguments
     *
     * @return object
     */
    public static function get($class, array $arguments = array())
    {
        if (false === self::has($class, $arguments)) {
            throw OutOfBoundsException::forNotFoundSingletonInstance($class);
        }

        $hash = self::getHash($arguments);

        return self::$instances[$class][$hash];
    }

    /**
     * @param string $class
     */
    public static function reset($class)
    {
        if (false === \array_key_exists($class, self::$instances)) {
            return;
        }

        unset(self::$instances[$class]);
    }

    /**
     * @param string $class
     * @param array  $arguments
     * @param object $object
     */
    public static function set($class, array $arguments, $object)
    {
        $hash                           = self::getHash($arguments);
        self::$instances[$class][$hash] = $object;
    }

    /**
     * @param array $arguments
     *
     * @return string
     */
    private static function getHash(array $arguments)
    {
        $serialize = \serialize($arguments);

        return \sha1($serialize);
    }
}

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

/**
 * Interface SingletonRegistryInterface.
 *
 * @package CoiSA\Singleton\Registry
 */
interface SingletonRegistryInterface
{
    /**
     * @param string $class
     * @param array  $arguments
     *
     * @return bool
     */
    public static function has($class, array $arguments);

    /**
     * @param string $class
     * @param array  $arguments
     * @param mixed  $object
     *
     * @return mixed
     */
    public static function set($class, array $arguments, $object);

    /**
     * @param string $class
     * @param array  $arguments
     *
     * @return object
     */
    public static function get($class, array $arguments = array());

    /**
     * @param string $class
     *
     * @return void
     */
    public static function reset($class);
}

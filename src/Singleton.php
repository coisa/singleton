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

    /**
     * Prevent class from being initialized.
     */
    private function __construct()
    {
    }

    /**
     * {@inheritDoc}
     */
    public static function getInstance()
    {
        $arguments = \func_get_args();
        $serialize = \serialize($arguments);
        $hash      = \sha1($serialize);

        if (false === \array_key_exists($hash, self::$instances)) {
            self::setInstance($hash, $arguments);
        }

        return self::$instances[$hash];
    }

    /**
     * @param string $hash
     * @param array  $arguments
     */
    private static function setInstance($hash, array $arguments)
    {
        $factory                = array('CoiSA\\Factory\\StaticFactory', 'create');
        self::$instances[$hash] = \call_user_func_array($factory, $arguments);
    }
}

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
        $className = \array_shift($arguments);

        if (false === \array_key_exists($hash, self::$instances)) {
            self::$instances[$hash] = StaticFactory::create($className, $arguments);
        }

        return self::$instances[$hash];
    }
}
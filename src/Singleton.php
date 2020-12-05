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
namespace CoiSA\Singleton;

use CoiSA\Factory\AbstractFactory;
use CoiSA\Factory\FactoryInterface;
use CoiSA\Singleton\Factory\SingletonFactory;
use CoiSA\Singleton\Registry\SingletonRegistry;

/**
 * Class Singleton.
 *
 * @package CoiSA\Singleton
 */
final class Singleton implements SingletonInterface
{
    // @codeCoverageIgnoreStart

    /**
     * Prevent class from being initialized.
     */
    private function __construct()
    {
    }

    // @codeCoverageIgnoreEnd

    /**
     * {@inheritdoc}
     */
    public static function getInstance()
    {
        $arguments = \func_get_args();
        $class     = \array_shift($arguments);
        $factory   = new SingletonFactory($class);

        return \call_user_func_array(array($factory, 'create'), $arguments);
    }

    /**
     * @param string           $class
     * @param FactoryInterface $factory
     */
    public static function setFactory($class, FactoryInterface $factory)
    {
        AbstractFactory::setFactory($class, $factory);
        SingletonRegistry::reset($class);
    }
}

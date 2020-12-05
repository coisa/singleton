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
namespace CoiSA\Singleton\Factory;

use CoiSA\Factory\AbstractFactory;
use CoiSA\Factory\FactoryInterface;
use CoiSA\Singleton\Registry\SingletonRegistry;

/**
 * Class SingletonFactory.
 *
 * @package CoiSA\Singleton\Factory
 */
final class SingletonFactory implements FactoryInterface
{
    /**
     * @var string
     */
    private $class;

    /**
     * SingletonFactory constructor.
     *
     * @param string $class
     */
    public function __construct($class)
    {
        $this->class = $class;
    }

    /**
     * {@inheritdoc}
     */
    public function create()
    {
        $arguments = \func_get_args();

        if (false === SingletonRegistry::has($this->class, $arguments)) {
            $factory = AbstractFactory::getFactory($this->class);
            $object  = \call_user_func_array(array($factory, 'create'), $arguments);

            SingletonRegistry::set($this->class, $arguments, $object);
        }

        return SingletonRegistry::get($this->class, $arguments);
    }
}

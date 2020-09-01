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

use CoiSA\Factory\CallableFactory;
use CoiSA\Factory\StaticFactory;
use PHPUnit\Framework\TestCase;

/**
 * Class SingletonTest
 *
 * @package CoiSA\Singleton
 */
final class SingletonTest extends TestCase
{
    /**
     * @expectedException \Error
     */
    public function testNewSingletonWillThrowError()
    {
        new Singleton();
    }

    public function testNewSingletonWithReflectionOnlyForOneHundredPercentOfTests()
    {
        $reflectionClass = new \ReflectionClass('CoiSA\\Singleton\\Singleton');
        $object          = $reflectionClass->newInstanceWithoutConstructor();
        $constructor     = $reflectionClass->getConstructor();

        $constructor->setAccessible(true);
        $constructor->invoke($object);
    }

    public function testGetInstanceWillReturnInstanceFromFactoryCreate()
    {
        StaticFactory::setFactory('stdClass', new CallableFactory(function ($arg1, $arg2) {
            $object = new \stdClass();
            $object->arg1 = $arg1;
            $object->arg2 = $arg2;

            return $object;
        }));

        $arg1 = \uniqid('arg1', true);
        $arg2 = \uniqid('arg2', true);

        $singleton = Singleton::getInstance('stdClass', $arg1, $arg2);

        self::assertInstanceOf('stdClass', $singleton);
        self::assertEquals($arg1, $singleton->arg1);
        self::assertEquals($arg2, $singleton->arg2);
    }

    public function testGetInstanceWillReturnSameInstanceEveryTime()
    {
        $object1 = Singleton::getInstance('stdClass');
        $object2 = Singleton::getInstance('stdClass');

        self::assertSame($object1, $object2);

        StaticFactory::setFactory('stdClass', new CallableFactory(function ($arg1, $arg2) {
            $object = new \stdClass();
            $object->arg1 = $arg1;
            $object->arg2 = $arg2;

            return $object;
        }));

        $arg1 = \uniqid('arg1', true);
        $arg2 = \uniqid('arg2', true);

        $object1 = Singleton::getInstance('stdClass', $arg1, $arg2);
        $object2 = Singleton::getInstance('stdClass', $arg1, $arg2);

        self::assertSame($object1, $object2);
    }

    /**
     * @expectedException \ReflectionException
     */
    public function testGetInstanceWithParametersOnClassWithoutConstructorWillThrowReflectionException()
    {
        Singleton::getInstance('stdClass', \uniqid('test', true));
    }

    public function testGetInstanceWithDifferentArgumentsWillReturnDifferentInstance()
    {
        StaticFactory::setFactory('stdClass', new CallableFactory(function ($arg1, $arg2) {
            $object = new \stdClass();
            $object->arg1 = $arg1;
            $object->arg2 = $arg2;

            return $object;
        }));

        $arg1 = \uniqid('arg1', true);
        $arg2 = \uniqid('arg2', true);
        $arg3 = \uniqid('arg3', true);

        $object1 = Singleton::getInstance('stdClass', $arg1, $arg2);
        $object2 = Singleton::getInstance('stdClass', $arg1, $arg3);

        self::assertNotSame($object1, $object2);
    }
}

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
namespace CoiSA\Singleton\Test;

use CoiSA\Singleton\Test\Stub\ExtendedAbstractSingleton;
use PHPUnit\Framework\TestCase;

/**
 * Class AbstractSingletonTest.
 *
 * @package CoiSA\Singleton\Test
 */
final class AbstractSingletonTest extends TestCase
{
    public function testExtendedObjectCannotBeCloned()
    {
        $reflectionClass = new \ReflectionClass('CoiSA\\Singleton\\AbstractSingleton');
        $cloneMethod     = $reflectionClass->getMethod('__clone');

        self::assertTrue($cloneMethod->isFinal());
        self::assertTrue($cloneMethod->isProtected());

        $object = ExtendedAbstractSingleton::getInstance();
        if (PHP_VERSION_ID < 70000) {
            $this->setExpectedException('ReflectionException');
            $cloneMethod->invoke($object);

            return;
        }

        try {
            clone $object;
        } catch (\Error $exception) {
            self::assertNotFalse(\strpos($exception->getMessage(), '__clone'));

            return;
        }

        self::fail('Cloning the singleton unexpectedly succeeded');
    }

    public function testGetInstanceWillReturnSameInstance()
    {
        self::assertSame(
            ExtendedAbstractSingleton::getInstance(),
            ExtendedAbstractSingleton::getInstance()
        );

        $argument = array(
            \uniqid('test', true),
            \uniqid('test', true),
        );

        self::assertSame(
            ExtendedAbstractSingleton::getInstance($argument),
            ExtendedAbstractSingleton::getInstance($argument)
        );
    }
}

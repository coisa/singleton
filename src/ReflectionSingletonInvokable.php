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
 * Class ReflectionSingletonInvokable
 *
 * @package CoiSA\Singleton
 */
final class ReflectionSingletonInvokable
{
    /**
     * Return a new instance of an object or classname.
     *
     * @param object|string $objectOrClassName
     *
     * @throws \ReflectionException
     *
     * @return object
     */
    public function __invoke($objectOrClassName)
    {
        $reflectionClass = new \ReflectionClass($objectOrClassName);

        if (null === $reflectionClass->getConstructor()) {
            return $reflectionClass->newInstanceWithoutConstructor();
        }

        return $reflectionClass->newInstance();
    }
}

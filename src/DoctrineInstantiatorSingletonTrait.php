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
 * Trait DoctrineInstantiatorSingletonTrait
 *
 * @package CoiSA\Singleton
 */
trait DoctrineInstantiatorSingletonTrait
{
    use SingletonTrait;

    /**
     * Create a new instance of this object.
     *
     * @return static
     */
    protected static function newInstance()
    {
        $doctrineInstantiatorSingletonInvokable = new DoctrineInstantiatorSingletonInvokable();

        return $doctrineInstantiatorSingletonInvokable(static::class);
    }
}

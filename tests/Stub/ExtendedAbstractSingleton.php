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
namespace CoiSA\Singleton\Test\Stub;

use CoiSA\Singleton\AbstractSingleton;

/**
 * Class ExtendedAbstractSingleton.
 *
 * @package CoiSA\Singleton\Test\Stub
 */
final class ExtendedAbstractSingleton extends AbstractSingleton
{
    /**
     * @var mixed
     */
    private $argument;

    /**
     * ExtendedAbstractSingleton constructor.
     *
     * @param null|mixed $argument
     */
    public function __construct($argument = null)
    {
        $this->argument = $argument;
    }
}

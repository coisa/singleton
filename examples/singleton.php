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
require_once __DIR__ . '/../vendor/autoload.php';

class MySingleton
{
    public $params;

    public function __construct()
    {
        $this->params = \func_get_args();
    }
}

$object = \CoiSA\Singleton\Singleton::getInstance('MySingleton');

\var_dump($object === \CoiSA\Singleton\Singleton::getInstance('MySingleton'));
\var_dump($object !== \CoiSA\Singleton\Singleton::getInstance('MySingleton', 1));

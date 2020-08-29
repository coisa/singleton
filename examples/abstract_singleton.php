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

use CoiSA\Singleton\AbstractSingleton;

require_once __DIR__ . '/../vendor/autoload.php';

class MySingleton extends AbstractSingleton
{
    public $params;

    public function __construct()
    {
        $this->params = \func_get_args();
    }
}

$object = MySingleton::getInstance();

\var_dump($object === MySingleton::getInstance());
\var_dump($object !== MySingleton::getInstance(1));

\var_dump(MySingleton::getInstance(1, 2, 3)->params);

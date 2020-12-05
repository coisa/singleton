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
namespace CoiSA\Singleton\Exception;

/**
 * Class OutOfBoundsException.
 *
 * @package CoiSA\Singleton\Exception
 */
final class OutOfBoundsException extends \CoiSA\Exception\Spl\OutOfBoundsException implements SingletonExceptionInterface
{
    /**
     * @param string     $class
     * @param mixed      $code
     * @param null|mixed $previous
     *
     * @return OutOfBoundsException
     */
    public static function forNotFoundSingletonInstance($class, $code = 0, $previous = null)
    {
        $message = \sprintf(
            'Given class "%s" are not set into the SingletonRegistry with given arguments.',
            $class
        );

        return self::create($message, $code, $previous);
    }
}

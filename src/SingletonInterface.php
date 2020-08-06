<?php

namespace CoiSA\Singleton;

/**
 * Interface SingletonInterface
 *
 * @package CoiSA\Singleton
 */
interface SingletonInterface
{
    /**
     * Return a shared instance of an object.
     *
     * @return mixed
     */
    public static function getInstance();
}

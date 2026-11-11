<?php

$root = dirname(__DIR__);
require $root . '/vendor/autoload.php';

$explicitConfiguration = false;
foreach (array_slice($_SERVER['argv'], 1) as $argument) {
    if ('--' === $argument) {
        break;
    }

    if ('--configuration' === $argument || '--no-configuration' === $argument
        || 0 === strpos($argument, '--configuration=') || 0 === strpos($argument, '-c')
    ) {
        $explicitConfiguration = true;
        break;
    }
}

if (!$explicitConfiguration && class_exists('Composer\\InstalledVersions')
    && version_compare(\Composer\InstalledVersions::getVersion('phpunit/phpunit'), '13.0.0', '>=')
) {
    array_splice($_SERVER['argv'], 1, 0, array('--configuration', $root . '/phpunit-modern.xml'));
}

require $root . '/vendor/bin/phpunit';

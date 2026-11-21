<?php
declare(strict_types=1);

if (PHP_SAPI === 'cli-server') {
    require_once dirname(__DIR__) . '/src/static-files.php';

    if (isPublicFile(__DIR__, $_SERVER['REQUEST_URI'] ?? '/')) {
        return false;
    }
}

require dirname(__DIR__) . '/vendor/autoload.php';
$app = require dirname(__DIR__) . '/src/bootstrap.php';
$app->run();

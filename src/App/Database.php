<?php

declare(strict_types=1);

use Pimple\Container;

/** @var Container $container */
$container['db'] = static function (): PDO {
    $dsn = 'sqlite:'.__DIR__.'/../../data/simulator.db';
    $pdo = new PDO($dsn);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    return $pdo;
};

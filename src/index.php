<?php

require_once 'application/lib/dev.php';

use application\core\Router;
use application\lib\Database;

spl_autoload_register(function (string $class) {
    $path = str_replace('\\', '/', $class) . '.php';
    if (file_exists($path))
        require $path;
});

$router = new Router();
$router->run();
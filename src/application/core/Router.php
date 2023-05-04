<?php

namespace application\core;

use application\core\View;

class Router
{
    protected array $routes = [];
    protected array $params = [];

    function __construct()
    {
        foreach ((require 'application/config/routes.php') as $route => $params) {
            $this->add($route, $params);
        }
    }

    public function add(string $route, array $params): void
    {
        $this->routes["#^$route$#"] = $params;
    }

    public function match(): bool
    {
        $url = trim($_SERVER['REQUEST_URI'], '/');
        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $url, $mathces)) {
                $this->params = $params;
                return true;
            }
        }
        return false;
    }

    public function run(): void
    {
        if (!$this->match())
            View::throwError(500);

        extract($this->params);
        $controller_class = 'application\controllers\\' . ucfirst($controller) . "Controller";


        $action_class = $action . 'Action';

        if (
            !class_exists($controller_class)
            && !method_exists($controller_class, $action_class)
        ) {
            View::throwError(404);
        }

        $controller = new $controller_class($this->params);
        $controller->$action_class();
    }
}
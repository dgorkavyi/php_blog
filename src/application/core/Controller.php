<?php

namespace application\core;

use application\core\View;

abstract class Controller
{
    public array $params;
    public array $acl;
    public $view;
    public $model;
    
    public function __construct(array $params)
    {
        $this->params = $params;
        $this->acl = require "application/acl/{$this->params['controller']}.php";
        if (!$this->checkAcl()) View::throwError(403);
        $this->view = new View($params);
        $this->model = $this->loadModel($params['controller']);
    }

    public function loadModel($name)
    {
        $name = ucfirst($name);
        $path = "application\models\\$name";

        if (!class_exists($path)) {
            echo $path;
        }

        return new $path;
    }
    
    public function checkAcl()
    {
        if ($this->isAcl('all')) return true;
        if (isset($_SESSION['authorize']['id']) && $this->isAcl('authorize')) return true;
        if (!isset($_SESSION['authorize']['id']) && $this->isAcl('guest')) return true;
        if (isset($_SESSION['admin']) && $this->isAcl('admin')) return true;
        return false;
    }

    protected function isAcl(string $key)
    {
        return in_array($this->params['action'], $this->acl[$key]);
    }
}

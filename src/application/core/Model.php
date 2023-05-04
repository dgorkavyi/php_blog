<?php

namespace application\core;

use application\lib\Database;

abstract class Model
{
    public $database;

    public function __construct()
    {
        $this->database = new Database();
    }
}
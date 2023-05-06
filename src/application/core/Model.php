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

    public function getPostsCount() {
        return $this->database->column('SELECT COUNT(id) FROM posts;');
    }

    public function postsList($route, $limitPerPage)
    {
        $start = ((($route['page'] ?? 1) - 1) * $limitPerPage);
        return $this->database->row("SELECT * FROM posts ORDER BY id DESC LIMIT $start, $limitPerPage;");
    }
}
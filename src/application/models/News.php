<?php

namespace application\models;

use application\core\Model;

class News extends Model
{
    public function getNews()
    {
        return $this->database->row("SELECT * FROM News;");
    }
}
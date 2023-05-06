<?php

namespace application\models;

use application\core\Model;

class Main extends Model
{
    public function get(): array
    {

        return $this->database->row("SELECT * FROM posts;");
    }
    public function getOne(string $id): array
    {
        return $this->database->row("SELECT * FROM posts WHERE id=$id;")[0];
    }
}

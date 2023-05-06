<?php

namespace application\models;

use application\core\Model;
use application\lib\Post;

class Admin extends Model
{
    public function add(Post $data): void {
        $params = [
            'id' => null,
            'title' => $data->name,
            'description' => $data->description,
            'text' => $data->text,
            'date' => date('h:i:s d/m/Y')
        ];
        $this->database->query('INSERT INTO posts VALUES(:id, :title, :description, :text, :date);', $params);
    }

    public function get(): array
    {
        return $this->database->row("SELECT * FROM posts;");        
    }
    public function delete(string $id): void
    {
        $this->database->row("DELETE FROM posts WHERE id=$id;");        
    }
}
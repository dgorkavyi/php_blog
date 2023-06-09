<?php

namespace application\models;

use application\core\Model;
use application\lib\Post;

class Admin extends Model
{
    public function add(Post $data): string
    {
        $params = [
            'id' => null,
            'title' => $data->title,
            'description' => $data->description,
            'text' => $data->text,
            'date' => date('h:i:s d/m/Y')
        ];
        $this->database->query('INSERT INTO posts VALUES(:id, :title, :description, :text, :date);', $params);
        return $this->lastId();
    }
    public function edit(Post $data, string $id): string
    {
        $title = $data->title;
        $description = $data->description;
        $text = $data->text;
        $date = date('h:i:s d/m/Y');
        $this->database->query("UPDATE posts SET title='$title', description='$description', text='$text', date='$date' WHERE id=$id;");
        return $id;
    }
    public function get(): array
    {
        return $this->database->row("SELECT * FROM posts;");
    }
    public function getOne(string $id): array
    {
        return $this->database->row("SELECT * FROM posts WHERE id=$id;")[0];
    }
    public function delete(string $id): void
    {
        $this->database->row("DELETE FROM posts WHERE id=$id;");
    }
    public function lastId(): string {
        return $this->database->lastInsertId('posts');
    }
    public function uploadImage($path, $id)
    {
        $ext = explode(".", $_FILES['img']['name'])[1];
        move_uploaded_file($path, "public/images/$id.$ext");
    }
}

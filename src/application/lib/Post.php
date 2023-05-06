<?php

namespace application\lib;

class Post
{
    public string $title;
    public string $description;
    public string $text;
    public string $img;

    private string $errorStatus;
    private string $errorText;

    public function __construct(array $post)
    {
        $this->title = $post['title'];
        $this->description = $post['description'];
        $this->text = $post['text'];
        $this->errorStatus = "";
        $this->errorText = "";
    }

    public function getErrorData(): array
    {
        return ["errorStatus" => $this->errorStatus, "errorText" => $this->errorText];
    }

    public function validate(bool $type = false): bool
    {
        if (iconv_strlen($this->title) < 3 or iconv_strlen($this->title) > 150) {
            $this->errorStatus = "Хибна довжина заголовка: ";
            $this->errorText = "мусить бути меншою за 150 літер та довшою за 3 літери.";
            return false;
        }
        if (iconv_strlen($this->description) < 3 or iconv_strlen($this->description) > 150) {
            $this->errorStatus = "Хибна довжина опису: ";
            $this->errorText = "мусить бути меншою за 150 літер та довшою за 3 літери.";
            return false;
        }
        if (iconv_strlen($this->text) < 3 or iconv_strlen($this->text) > 1500) {
            $this->errorStatus = "Неправильно введений текст: ";
            $this->errorText = "повинен бути не менше трьох символів та не більше 1500.";
            return false;
        }
        if (!$type and empty($_FILES['img']['tmp_name'])) {
            $this->errorStatus = "Поле картинки: ";
            $this->errorText = "не задано.";
            return false;
        }
        
        $ext = explode(".", $_FILES['img']['name'])[1];
        
        if(!($ext === 'jpg' || $ext === 'png' || $ext === 'jpeg')) {
            $this->errorStatus = "File type error: ";
            $this->errorText = "jpg, jpeg, png is only allowed.   |$ext|";
            return false;
        }

        return true;
    }
}

<?php

namespace application\lib;

class ContactForm
{
    public string $name;
    public string $email;
    public string $text;

    private string $errorStatus;
    private string $errorText;

    public function __construct(array $post)
    {
        $this->name = $post['name'];
        $this->email = $post['email'];
        $this->text = $post['text'];
        $this->errorStatus = "";
        $this->errorText = "";
    }

    public function getErrorData(): array
    {
        return ["errorStatus" => $this->errorStatus, "errorText" => $this->errorText];
    }

    public function validate(): bool
    {
        if (iconv_strlen($this->name) < 3 || iconv_strlen($this->name) > 40) {
            $this->errorStatus = "Хибна довжина імені: ";
            $this->errorText = "мусить бути меншою за 40 літер та довшою за 3 літери.";
            return false;
        } 
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $this->errorStatus = "Неправильно введена пошта: ";
            $this->errorText = "повинна бути написаною за зразком - 'myemail@gmail.com'";
            return false;
        } 
        if (iconv_strlen($this->text) > 500) {
            $this->errorStatus = "Хибна довжина тексту: ";
            $this->errorText = "мусить бути меншою за 500 літер.";
            return false;
        } 

        return true;
    }
}

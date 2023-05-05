<?php

namespace application\lib;

class LoginForm
{
    public string $login;
    public string $password;
    private string $errorStatus;
    private string $errorText;
    public string $realLogin;
    public string $realPassword;

    public function __construct(array $post, array $realData)
    {
        $this->login = $post['login'];
        $this->password = $post['password'];
        $this->errorStatus = "";
        $this->errorText = "";
        $this->realLogin = $realData["login"];
        $this->realPassword = $realData["password"];
    }

    public function getErrorData(): array
    {
        return ["errorStatus" => $this->errorStatus, "errorText" => $this->errorText];
    }

    public function validate(): bool
    {
        if ($this->login !== $this->realLogin || $this->password !== $this->realPassword) {
            $this->errorStatus = "Помилка: ";
            $this->errorText = "хибні логін або пароль.";
            return false;
        } 
        return true;
    }
}

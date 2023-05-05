<?php

namespace application\controllers;

use application\core\Controller;
use application\lib\ContactForm;

class MainController extends Controller
{
    public function indexAction(): void
    {
        $this->view->render('Blog:Main', []);
    }

    public function contactAction(): void
    {
        if (!empty($_POST)) {
            $form = new ContactForm($_POST);

            if ($form->validate()) {
                $this->view->message("Запит зроблено вдало", "");
                mail('getaha3604@in2reach.com', "Повідомлення з блогу, від {$_POST['email']}", $form->text);
            } else {
                extract($form->getErrorData());
                $this->view->message($errorStatus, $errorText);
            }
            exit();
        }
        $this->view->render('Blog:Contact', []);
    }

    public function aboutAction(): void
    {
        $this->view->render('Blog:About', []);
    }

    public function postAction(): void
    {
        $this->view->render('Blog:Post', []);
    }
}

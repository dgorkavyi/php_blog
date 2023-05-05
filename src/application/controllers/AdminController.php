<?php

namespace application\controllers;

use application\core\Controller;
use application\lib\LoginForm;

class AdminController extends Controller
{
    public function __construct($params)
    {
        parent::__construct($params);
        $this->view->layout = 'admin';
    }
    public function loginAction(): void
    {
        if(!empty($_SESSION['admin']) && $_SESSION['admin'] === true) {
            $this->view->redirect("/admin/add");
        }
        if (!empty($_POST)) {
            $form = new LoginForm($_POST, require 'application/config/admin.php');

            if ($form->validate()) {
                $_SESSION['admin'] = true;
                $this->view->location("admin/add");
            } else {
                extract($form->getErrorData());
                $this->view->message($errorStatus, $errorText);
            }
            exit();
        }

        $this->view->render('Blog:Login', []);
    }
    public function logoutAction(): void
    {
        unset($_SESSION['admin']);
        $this->view->redirect('/');
    }
    public function addAction(): void
    {
        $this->view->render('Blog:Add post', []);
    }
    public function postsAction(): void
    {
        $this->view->render('Blog:Posts', []);
    }
    public function editAction(): void
    {
        $this->view->render('Blog:Edit post', []);
    }
    public function deleteAction(): void
    {
        $this->view->render('Blog:Delete post', []);
    }
}
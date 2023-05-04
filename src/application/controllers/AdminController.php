<?php

namespace application\controllers;

use application\core\Controller;

class AdminController extends Controller
{
    public function loginAction(): void
    {
        $this->view->render('Blog:Login', []);
    }
    public function logoutAction(): void
    {
        $this->view->render('Blog:Logout', []);
    }
    public function addAction(): void
    {
        $this->view->render('Blog:Add post', []);
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
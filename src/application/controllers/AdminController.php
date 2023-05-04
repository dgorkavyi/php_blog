<?php

namespace application\controllers;

use application\core\Controller;

class AdminController extends Controller
{
    public function __construct($params)
    {
        parent::__construct($params);
        $this->view->layout = 'admin';
    }
    public function loginAction(): void
    {
        $this->view->render('Blog:Login', []);
    }
    public function logoutAction(): void
    {
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
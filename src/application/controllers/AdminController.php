<?php

namespace application\controllers;

use application\core\Controller;
use application\lib\LoginForm;
use application\lib\Post;

class AdminController extends Controller
{
    public function __construct($params)
    {
        parent::__construct($params);
        $this->view->layout = 'admin';
    }
    public function loginAction(): void
    {
        if (isset($_SESSION['admin'])) {

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
        if (!empty($_POST)) {

            $post = new Post($_POST);

            if ($post->validate()) {

                $id = $this->model->add($post);
                $this->model->uploadImage($_FILES['img']['tmp_name'], $id);
                $this->view->location("admin/add");
            } else {

                extract($post->getErrorData());
                $this->view->message($errorStatus, $errorText);
            }
        }

        $this->view->render('Blog:Add post', []);
    }
    public function postsAction(): void
    {
        $list = $this->model->get();
        $this->view->render('Blog:Posts', ['list' => $list]);
    }
    public function editAction(): void
    {
        $postArr = $this->model->getOne($this->params['id']);

        if (!empty($_POST)) {
            $post = new Post($_POST);
            if ($post->validate(true)) {

                $id = $this->model->edit($post, $this->params['id']);

                if (isset($_FILES['img']['tmp_name']) && iconv_strlen($_FILES['img']['tmp_name']) > 0) {
                    $this->model->uploadImage($_FILES['img']['tmp_name'], $id);
                }

                $this->view->location("admin/posts");
            } else {

                extract($post->getErrorData());
                $this->view->message($errorStatus, $errorText);
            }
        }
        $vars = [
            'data' => $postArr
        ];
        $this->view->render('Blog:Edit post', $vars);
    }
    public function deleteAction(): void
    {
        if ($_SESSION['admin'])
            $this->model->delete($this->params['id']);
        $this->view->redirect('/admin/posts');
    }
}

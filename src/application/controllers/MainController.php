<?php

namespace application\controllers;

use application\core\Controller;

class MainController extends Controller
{
    public function indexAction(): void
    {
        $this->view->render('Blog:Main', []);
    }
    public function contactAction(): void
    {
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
<?php

namespace application\controllers;

use application\core\Controller;

class NewsController extends Controller
{
    public function showAction(): void
    {
        $news = $this->model->getNews();
        $this->view->render('News', ['news' => $news]);
    }
}
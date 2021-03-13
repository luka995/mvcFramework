<?php

namespace app\controller;

use app\model\User;
use app\model\News;
use app\view\View;

class SiteController extends Controller
{
    public function actionIndex()
    {
        $categoryId = $_GET['categoryId'] ?? null;
        $newsDb = new News();
        $newsList = $newsDb->getAllForDisplay($categoryId);
        return View::render('site/index', ['newsList' => $newsList]);
    }   
}

<?php

namespace app\controller;

use app\view\View;
use app\model\Category;
use app\model\News;
use app\model\User;
use app\model\Comment;

class NewsController extends Controller
{
    public function actionPublish() 
    {
        if (!User::isAdmin()) {
            throw new \Exception('Nemate prava pristupa');
        }
        $newsDb = new News();
        $data = $_POST['News'] ?? [];
        if (!empty($data) && $newsDb->post($data)) {
            $this->redirect('index.php');
        }
        $categoryDb = new Category();
        $categories = $categoryDb->selectAll('category_name');        
        return View::render('news/post', ['categories' => $categories]);
    }
    
    public function actionView()
    {
        $newsId = $_GET['newsId'];
        $newsDb = new News();
        $news = $newsDb->getOneForDisplay($newsId);
        $commentsDb = new Comment();
        
        $data = $_POST['Comment'] ?? false;
        if ($data && $commentsDb->save($data, $newsId)) {
            $this->redirect('index.php?controller=News&action=view&newsId='.$newsId);
        }
        
        $comments = $commentsDb->getAllForDisplay($newsId);
        return View::render('news/view', ['post' => $news, 'comments' => $comments]);
    }
    
    public function actionDeleteComment()
    {
        $commentId = $_GET['commentId'];        
        $commentDb = new Comment();
        $comment = $commentDb->selectOne($commentId);
        if (!$comment) {
            throw new \Exception('Komentar ne postoji!');
        }        
        if (!Comment::canDelete($comment['comment_user_id'])) {
            throw new \Exception('Nemate prava da izbrišete komentar!');
        }        
        $commentDb->delete($commentId);
        $this->redirect('index.php?controller=News&action=view&newsId='.$comment['comment_news_id']);
    }
    
    public function actionDelete()
    {
        if (!User::isAdmin()) {
            throw new \Exception('Samo admin sme da briše.');
        }
        $newsId = $_GET['newsId'];
        $newsDb = new News();        
        $newsDb->delete($newsId);
        $this->redirect('index.php');
    }
}

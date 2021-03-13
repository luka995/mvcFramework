<?php
namespace app\controller;

use app\view\View;
use app\model\User;

class UserController extends Controller
{
    public function actionRegister()
    {        
        $userDb = new User();  
        $data = $_POST['User'] ?? [];
        if (!empty($data) && ($id = $userDb->register($data))) {
            User::login($id);
            $this->redirect("index.php");
        }
        $errors = $userDb->getErrors();
        return View::render('user/register', [
            'naslov' => 'Registracija', 
            'errors' => $errors,
            'data'   => $data
        ]);
    }  
    
    public function actionLogout()
    {
        User::logout();
        $this->redirect("index.php");
    }    
    
    public function actionLogin()
    {
        $userDb = new User();
        if (!empty($_POST['User']) && ($id = $userDb->authenticate($_POST['User']))) {
            User::login($id);
            $this->redirect('index.php');
        }
        $errors = $userDb->getErrors();
        return View::render('user/login', [
            'naslov' => 'Prijava', 
            'errors' => $errors,
            'data'   => $_POST['User'] ?? []
        ]);
    }
}

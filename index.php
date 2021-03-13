<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

session_start();        

include __DIR__ . '/vendor/autoload.php';
use app\model\User;
use app\model\Category;

try {
    $controller = \app\controller\Controller::create();
    $main = $controller->run();
} catch (\Throwable $ex) {
    $main = $ex->getMessage();
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">

        <title></title>
        <link rel="stylesheet" type="text/css" href="style.css">

    </head>
    <body>
        <header>
            <nav>
                <div class="main-wrapper">
                    <div class="nav-bar">
                        <ul>
                            <li><a href="index.php">Home</a></li>
                            <li><a href="#">Contact</a></li>                            
                            <?php if (User::getLoggedId()): ?>
                                <?php if (User::isAdmin()): ?>
                                    <li><a href="index.php?controller=News&action=publish">Nova vest</a></li>                                
                                <?php endif;?>
                            <li>
                                <a href="index.php?controller=User&action=logout">Odjava - 
                                <?= 
                                    htmlspecialchars(User::getLoggedUser()['user_first']. ' ' . 
                                    User::getLoggedUser()['user_last']) 
                                ?>
                                </a>
                            </li>
                            <?php else:?>
                                <li><a href="index.php?controller=User&action=register">Registracija</a></li>                                
                                <li><a href="index.php?controller=User&action=login">Prijava</a></li>
                            <?php endif;?>
                        </ul>
                    </div>
                    <div class="nav-login">
  
                    </div>

                </div>
            </nav>
        </header>

        <div class="main-wrapper">
            <div style="float:left; width:68%; min-height: 300px; padding: 10px; border:1px solid red;">
                <?= $main ?>
            </div>
            <div style="float:right; width:26%; padding:10px; border:1px solid blue; min-height: 300px;">
                <ul>
                <?php 
                    $categoryDb = new Category();
                    foreach ($categoryDb->selectAll('category_name') as $category): 
                ?>        
                    <li>
                        <a href="index.php?Controller=site&action=index&categoryId=<?=$category['category_id']?>">
                            <?= htmlspecialchars($category['category_name']) ?>
                        </a>
                    </li>
                <?php endforeach;?>
                </ul>
            </div>
        </div>
    </body>
</html>

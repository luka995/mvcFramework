<?php

namespace app\view;

class View 
{
    public static function render($file, $data)
    {
        extract($data);
        ob_start();
        include __DIR__ . "/$file.php";
        return ob_get_clean();
    }
    
    public static function excerpt($post, $n = 500)
    {
        $striped = strip_tags($post);
        return mb_substr($striped, 0, $n, 'UTF-8') . '...';
    }
    
}

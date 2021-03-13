<?php

namespace app\model;

class Comment extends Db
{
    protected function columns() 
    {
        return ['comment_news_id', 'comment_user_id',  'comment_date', 'comment_message'];
    }

    protected function tableName() 
    {
        return 'comment';
    }

    protected function validate($data) 
    {
        if (empty($data['comment_message'])) {
            $this->errors['comment_message'] = 'Unesite tekst komentara';
        }
        return empty($this->errors);        
    }  
    
    public function getAllForDisplay($news_id = null) 
    {
        $sql = <<<SQL
            select comment.*, user_first, user_last, user_email
            from comment
            inner join user on comment_user_id = user_id
SQL;
        $params = [];
        if ($news_id) {
            $params = [$news_id];            
            $sql .= ' where comment_news_id=?';
        }
        
        $sql .= ' order by comment_date';
        return $this->selecteAllBySql($sql, $params);
    }
    
    public function save($data, $newsId) 
    {
        $data['comment_news_id'] = $newsId;
        $data['comment_date'] = date('Y-m-d H:i:s');
        $data['comment_user_id'] = User::getLoggedId();
        return $this->write($data);
    }    
    
    public static function canDelete($commentUserId)
    {
        if (User::isAdmin()) {
            return true;
        }        
        return User::getLoggedId() == $commentUserId;
    }
    
}

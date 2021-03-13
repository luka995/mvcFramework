<?php

namespace app\model;

class News extends Db
{
    //put your code here
    protected function tableName() 
    {
        return 'news';
    }

    protected function columns() 
    {
        return ['news_title', 'news_date', 'news_article', 'news_user_id', 'news_category_id'];
    }

    public function post($data)
    {
        $data['news_date'] = date('Y-m-d H:i:s');
        $data['news_user_id'] = User::getLoggedId();
        return $this->write($data);
    }

    protected function validate($data) 
    {
        if (empty($data['news_article'])) {
            $this->errors['news_article'] = 'Unesite tekst vesti';
        }
        if (empty($data['news_title'])) {
            $this->errors['news_title'] = 'Unesite naslov';
        }
        if (empty($data['news_category_id'])) {
            $this->errors['news_category_id'] = 'Izaberite kategoriju';
        }
        return empty($this->errors);
    }

    public function getAllForDisplay($category_id = null) 
    {
        $sql = <<<SQL
            select news.*, category_name, user_id, user_first, user_last, user_email, user_admin
            from news
            inner join user on news_user_id = user_id
            inner join category on news_category_id = category_id
SQL;
        if ($category_id) {
            $sql .= ' where category_id=?';
        }
        
        $sql .= ' order by news_date desc';
        $params = [];
        if ($category_id) {
            $params = [$category_id];
        }        
        return $this->selecteAllBySql($sql, $params);
    }
    
    public function getOneForDisplay($id) 
    {
        $sql = <<<SQL
            select news.*, category_name, user_id, user_first, user_last, user_email, user_admin
            from news
            inner join user on news_user_id = user_id
            inner join category on news_category_id = category_id
            where news_id = ?
SQL;
        $rows = $this->selecteAllBySql($sql, [$id]);
        if ($rows) {
            return $rows[0];
        }
        return null;
    }
    
}

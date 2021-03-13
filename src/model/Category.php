<?php

namespace app\model;

class Category extends Db
{
    protected function columns() {
        return ['category_name'];
    }

    protected function tableName() {
        return 'category';
    }

    protected function validate($data) 
    {
        if (empty($data['category_name'])) {
            $this->errors['category_name'] = 'Unesite naziv kategorije';
        }
        return empty($this->errors);
    }    
}

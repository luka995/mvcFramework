<?php

namespace app\model;

class User extends Db
{
    protected function tableName() 
    {
        return 'user';
    }

    protected function columns() 
    {        
        return ['user_first', 'user_last', 'user_email', 'user_pwd', 'user_admin'];
    }

    protected function validate($data) 
    {
        if (empty($data['user_first'])) {
            $this->errors['user_first'] = 'Ime korisnika ne sme biti prazno!';
        }
        if (empty($data['user_last'])) {
            $this->errors['user_last'] = 'Prezime korisnika ne sme biti prazno!';
        }
        if (empty($data['user_email'])) {
            $this->errors['user_email'] = 'Imejl korisnika ne sme biti prazan!';
        } else if ( ! filter_var($data['user_email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['user_email'] = 'Imejl nije ispravan!';
        } else if ($this->selectOneBy('user_email', $data['user_email'])) {
            $this->errors['user_email'] = 'Imejl je zauzet!';
        }
        if ( ! empty($data['password'])) {
            $pass = $data['password'];            
            if (strlen($pass) < 8) {
                $this->errors['user_pwd'] = 'Lozinka mora sadržati najmanje 8 karaktera';
            } else if (!preg_match('/[A-Z]+/', $pass) || !preg_match('/[a-z]+/', $pass) || !preg_match('/[0-9]+/', $pass)) {
                $this->errors['user_pwd'] = 'Lozinka mora sadržati bar jedno veliko, malo slovo i broj';
            }            
        } else {
            $this->errors['user_pwd'] = 'Lozinka ne sme biti prazna!';
        }
        return !$this->errors;
    }
    
    public function authenticate($data)
    {
        if (empty($data['user_email'])) {
            $this->errors['user_email'] = 'Imejl korisnika ne sme biti prazan!';
        } else if (!filter_var($data['user_email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['user_email'] = 'Imejl nije ispravan!';
        }
        if (empty($data['password'])) {
            $this->errors['user_pwd'] = 'Unesite lozinku!';
        }
        if (!$this->errors) {
            $user = $this->selectOneBy('user_email', $data['user_email']);
            if ( ! $user || ! password_verify($data['password'], $user['user_pwd'])) {
                $this->errors['user_email'] = 'Pogrešan email ili lozinika';
            }
        }
        if (!$this->errors) {
            return $user['user_id'];
        }
        return false;
    }
    
    public static function login($id)
    {
        $_SESSION['userId'] = $id;
    }
    
    public static function logout()
    {
        session_destroy();
    }
    
    public static function getLoggedId()
    {
        if (empty($_SESSION['userId'])) {
            return false;
        }
        return intval($_SESSION['userId']);
    }
    
    private static $loggedUser = null;
    public static function getLoggedUser()
    {
        if (self::$loggedUser === null) {
            $id = self::getLoggedId();
            if (!$id) {
                return [];
            }
            $userDb = new self();
            self::$loggedUser = $userDb->selectOne($id);
        }
        return self::$loggedUser;
    }
    
    public static function isAdmin()
    {
        return self::getLoggedId() && self::getLoggedUser()['user_admin'];
    }
    
    public function register($data) 
    {
        if (!empty($data['password'])) {
            $data['user_pwd'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }
        $data['user_admin'] = 0;
        return $this->write($data);
    }
    
}

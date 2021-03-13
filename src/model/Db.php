<?php
namespace app\model;

abstract class Db
{
    private static $connection = null;

    protected $errors = [];
    
    protected function getConn()
    {
        if (self::$connection === null) {
            $config = include __DIR__ . '/../../config.php';
            $db = $config['db'];
            $dbname = $db['name'];            
            self::$connection = new \PDO("mysql:host=localhost;dbname=$dbname;charset=utf8;", $db['user'], $db['password'], 
            [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
            ]);            
        }
        return self::$connection;
    }
    
    protected abstract function tableName();
    protected abstract function columns();
    protected abstract function validate($data);
    
    public function getErrors()
    {
        return $this->errors;
    }
    
    public function getIdColumn()
    {
        return $this->tableName() . '_id';
    }
    
    public function write($data)
    {
        if (!$this->validate($data)) {
            return false;
        }
        $colArray = $this->columns();
        $table = $this->tableName();
        $columns = implode(', ', $colArray);
        $valPlaceholders = rtrim(str_repeat('?,', count($colArray)), ','); 
        $sql = "INSERT INTO $table($columns) VALUES($valPlaceholders)";
        $stm = $this->getConn()->prepare($sql);
        for ($i=1; $i <= count($colArray); $i++) {
            $column = $colArray[$i-1];
            $val = $data[$column];
            $stm->bindValue($i, $val);
        }
        if ($stm->execute()) {
            return $this->getConn()->lastInsertId();            
        }
        return false;
    }
    
    public function update($id, $data)
    {
        
    }
    
    public function delete($id)
    {
        $table = $this->tableName();
        $sql = 'DELETE FROM ' . $table . ' WHERE ' . $this->getIdColumn() . '=?';
        $stm = $this->getConn()->prepare($sql);
        $stm->bindValue(1, $id);        
        return $stm->execute();        
    }
    
    public function selectAll($orderBy = false)
    {
        $table = $this->tableName();
        $sql = "SELECT * FROM $table " . ($orderBy ? " ORDER BY $orderBy" : '');
        $stm = $this->getConn()->prepare($sql);
        $stm->execute();
        return $stm->fetchAll();                  
    }
    
    /**
     * 
     * @param String $sql
     * @param array $params 
     */
    public function selecteAllBySql($sql, $params = [])
    {
        $stm = $this->getConn()->prepare($sql);
        for ($i=1; $i <= count($params); $i++) {
            $stm->bindValue($i, $params[$i-1]);
        }
        $stm->execute();
        return $stm->fetchAll();                  
    }
    
    public function selectOne($id)
    {
        return $this->selectOneBy($this->getIdColumn(), $id);
    }
    
    public function selectOneBy($column, $value)
    {
        $table = $this->tableName();
        $sql = "SELECT * FROM $table WHERE $column=?";
        $stm = $this->getConn()->prepare($sql);
        $stm->bindValue(1, $value);
        $stm->execute();
        return $stm->fetch();        
    }
    
    public function selectAllBy($column, $value, $orderBy = false)
    {
        $table = $this->tableName();
        $sql = "SELECT * FROM $table WHERE $column=?" . ($orderBy ? " ORDER BY $orderBy" : '');
        $stm = $this->getConn()->prepare($sql);
        $stm->bindValue(1, $value);
        $stm->execute();
        return $stm->fetchAll();        
    }    
    
        
}


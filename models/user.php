<?php
namespace Models;

use PDOStatement;

class User extends \Core\Model{
    public $id;
    private $email;
    private $password;

    private $confirm;

    public function __construct($email, $password, $confirm)
    {
        $this->email = $email;
        $this->password = $password;
        $this->confirm = $confirm;
    }

    public function save():void 
    {
        $pdo = \Db\Db::getPdo();
        $sql = "
            INSERT INTO users (email, password) VALUES ($this->email, $this->password)
        ";
        $query = $pdo->prepare($sql);
        $affected = $query->execute();
        echo var_dump($affected);
    }

    public function validate(): bool
	{
        if(preg_match("/^(?:[a-z0-9]+(?:[-_.]?[a-z0-9]+)?@[a-z0-9_.-]+(?:\.?[a-z0-9]+)?\.[a-z]{2,5})$/i", $this->email) && $this->confirm === $this->password){
            return true;
        }else{
            return false;
        }
    }

    public static function get_all()
    {   
        $pdo = \Db\Db::getPdo();
        $sql = "
            SELECT * FROM users;
        ";
        $result = $pdo->prepare($sql);
        $result->execute();
        return $result;
    }
}
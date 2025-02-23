<?php
class Db {
    protected static $pdo;

    private function __construct() {
        $env = parse_ini_file('.env');
        $dsn = 'pgsql:host='.$env['HOST'].';port='.$env['PORT'].';dbname='.$env['DB_NAME'].';charset=UTF8';
        
        $this->pdo = new PDO($dsn,$env['USER'],$env['PASSWORD']);
    }
    public static function getPdo():PDO {
        if (self::$pdo === null) {
            self::$pdo = new self();
        }
        return self::$pdo;
    }

    public static function init(){
        $sql = '
            CREATE TABLE IF NOT EXISTS user (
                id serial PRIMARY KEY, 
                email string,
                password string
            );
        ';
        $query = self::getPdo()->prepare($sql);
        $query->execute();
        $sql = '
            INSERT INTO user (email, password) VALUES 
            (\'test@test.ru\', \'827ccb0eea8a706c4c34a16891f84e7b\'),
            (\'test1@test.ru\', \'827ccb0eea8a706c4c34a16891f84e7b\'),
            (\'test2@test.ru\', \'827ccb0eea8a706c4c34a16891f84e7b\')
        ';
    }
}
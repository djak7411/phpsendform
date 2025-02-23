<?php
namespace Db;
class Db {
    protected static $pdo;

    private function __construct() {
        
        
       
    }
    public static function getPdo():\PDO {
        if (self::$pdo === null) {
            self::$pdo = new self();
            $env = parse_ini_file('.env');
            $dsn = 'pgsql:host='.$env['HOST'].';port='.$env['PORT'].';dbname='.$env['DB_NAME'];
            self::$pdo = new \PDO($dsn,$env['USER'],$env['PASSWORD']);
        }
        return self::$pdo;
    }

    public static function init(){
        $sql = '
            CREATE TABLE IF NOT EXISTS users (
                id serial PRIMARY KEY, 
                email VARCHAR UNIQUE,
                password VARCHAR
            );
        ';
        self::getPdo()->query($sql);

        $sql = '
            INSERT INTO users (email, password) VALUES 
            (\'test@test.ru\', \'827ccb0eea8a706c4c34a16891f84e7b\'),
            (\'test1@test.ru\', \'827ccb0eea8a706c4c34a16891f84e7b\'),
            (\'test2@test.ru\', \'827ccb0eea8a706c4c34a16891f84e7b\')
        ';
        self::getPdo()->query($sql);
    }
}
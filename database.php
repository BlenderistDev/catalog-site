<?php

class Database 
{
    private static $root;
    private static $root_password;
    private static $host;
    private static $dbName;

    public static function getPDO(){
        self::readConfig();
        $root = self::$root;
        $root_password = self::$root_password;
        $host = self::$host;
        $dbName = self::$dbName;
        try {
            $pdo = new PDO("mysql:host=$host;dbname=$dbName", $root, $root_password);//пробуем подключиться к бд
        } catch (PDOException $e) {//создаем бд в случае ошибки
            $pdo = new PDO("mysql:host=$host", $root, $root_password);
            $pdo->exec("CREATE DATABASE `$dbName` CHARACTER SET=utf8 COLLATE utf8_unicode_520_ci"); 
            $pdo = new PDO("mysql:host=$host;dbname=$dbName", $root, $root_password);
            //таблица категория
            $pdo->exec("CREATE TABLE category (
                id INT(11) NOT NULL AUTO_INCREMENT,
                name TEXT NOT NULL,
                summary TEXT,
                fullSummary TEXT,
                activity INT(11) NOT NULL,
                PRIMARY KEY (id)
            )");
            //таблица товаров
            $pdo->exec("CREATE TABLE goods (
                id INT(11) NOT NULL AUTO_INCREMENT,
                name TEXT NOT NULL,
                summary TEXT,
                fullSummary TEXT,
                activity INT(11) NOT NULL,
                amount INT(11) NOT NULL,
                booking Int(11) NOT NULL,
                PRIMARY KEY (id)
            )");
            //промежуточная таблица goods_category
            $pdo->exec("CREATE TABLE goods_category (
                good_id INT(11) NOT NULL,
                category_id INT(11) NOT NULL,
                FOREIGN KEY (good_id) REFERENCES goods (id),
                FOREIGN KEY (category_id) REFERENCES category (id),
                UNIQUE( `good_id`, `category_id`)
            )");
        }
        $pdo->query( "SET CHARSET utf8" );//поддержа кирилицы
        return $pdo;
    }
    // чтение конфигурационного файла бд
    private static function readConfig(){
        set_error_handler(function(){
            throw new Exception();
        }, E_WARNING);
        try{
            $config = json_decode(file_get_contents('config.json'));
            self::$root = $config->root;
            self::$root_password = $config->root_password;
            self::$dbName = $config->dbName;
            self::$host = $config->host;
        }catch(Exception $e){
            print "Invalid database config";
        }
        restore_error_handler();

    }
}

<?php

require_once("model\database.php");
// верхний уровень абстракции таблиц в базе данных
abstract class Table
{
    //получение объекта доступа к бд
    protected static function getPDO(){
        return Database::getPDO();
    }
    // получаем данные таблицы
    public static function getData()
    {
        $pdo = self::getPDO();
        $tableName = static::getTableName();
        $query = "Select * From $tableName";
        $data = $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    } 
    abstract protected static function getTableName();
    abstract protected static function validate($data);
}
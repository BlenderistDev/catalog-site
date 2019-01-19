<?php

require_once("dbTable.php");
// абстракция для таблиц - каталогов
abstract class Catalog extends Table
{
    // получаем только активные данные
    public static function getActiveData()
    {
        $pdo = self::getPDO();
        $tableName = static::getTableName();
        $query = "Select * From $tableName Where activity > 0";
        $data = $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    } 
    // получаем список елементов таблицы
    public static function getList()
    {
        $list = [];
        $pdo = self::getPDO();
        $tableName = static::getTableName();
        $query = "Select * From $tableName";
        $data = $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
        foreach($data as $value){
            $list[]=[
                'name' => $value['name'],
                'id' => $value['id'],
            ];
        }
        return $list;
    } 
    // получаем елемент таблицы по id
    public static function getInstanse($id){
        $pdo = self::getPDO();
        $tableName = static::getTableName();
        $query = "Select * From $tableName Where id = :id";
        $data = $pdo->prepare($query);
        $data->execute(['id'=>$id]);
        return $data->fetch(PDO::FETCH_ASSOC);
    }
    abstract public static function add($post);
    abstract public static function edit($post);
}
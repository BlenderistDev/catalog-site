<?php

require_once("model\dbTable.php");
// абстракция для таблиц - каталогов
abstract class Catalog extends Table
{
    public function __construct(){
        parent::__construct();
    }
    // получаем только активные данные
    public function getActiveData()
    {
        $pdo = $this->PDO;
        $tableName = $this->tableName;
        $query = "Select * From $tableName Where activity > 0";
        $data = $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    } 
    // получаем список елементов таблицы
    public function getList()
    {
        $list = [];
        $pdo = $this->PDO;
        $tableName = $this->tableName;
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
    public function getInstanse($id){
        $pdo = $this->PDO;
        $tableName = $this->tableName;
        $query = "Select * From $tableName Where id = :id";
        $data = $pdo->prepare($query);
        $data->execute(['id'=>$id]);
        return $data->fetch(PDO::FETCH_ASSOC);
    }
    abstract public function add($post);
    abstract public function edit($post);
    
}
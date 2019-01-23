<?php

require_once("model\database.php");
// верхний уровень абстракции таблиц в базе данных
abstract class Table
{
    protected $PDO;
    public function __construct(){
        $this->PDO = Database::getPDO();
    }
    //получение объекта доступа к бд
    protected function getPDO(){
        return $this->PDO;
    }
    // получаем данные таблицы
    public function getData()
    {
        $pdo = $this->getPDO();
        $tableName = $this->getTableName();
        $query = "Select * From $tableName";
        $data = $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    } 
    abstract protected function getTableName();
    abstract protected function validate($data);
}
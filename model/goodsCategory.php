<?php

require_once("model\goods.php");
require_once("model\category.php");
require_once("model\dbTable.php");

class GoodsCategory extends Table
{
    public function __construct()
    {
        parent::__construct();
        $this->tableName = "goods_category";
    }
    //получение категорий по id товара
    public function getCategories($id)
    {
        $array=[];
        $pdo = $this->PDO;
        $tableName = $this->tableName;
        $query = "Select category_id From $tableName Where good_id = :id";
        $data = $pdo->prepare($query);
        $data->execute(['id'=>$id]);
        $data = $data->fetchAll(PDO::FETCH_ASSOC);
        foreach ($data as $value){
            $array[]=[
                'name' => (new Category)->getInstanse($value['category_id'])['name'],
                'id' => $value['category_id'],
            ];
        }
        return $array;
    }
    //получение товаров по id категории
    public function getGoods($id)
    {
        $array=[];
        $pdo = $this->PDO;
        $tableName = $this->tableName;
        $query = "Select good_id From $tableName Where category_id = :id";
        $data = $pdo->prepare($query);
        $data->execute(['id'=>$id]);
        $data = $data->fetchAll(PDO::FETCH_ASSOC);
        foreach ($data as $value){
            $array[]=[
                'name' => (new Goods)->getInstanse($value['good_id'])['name'],
                'id' => $value['good_id'],
            ];
        }
        return $array;
    }
    // удаление записи
    public function del($good_id,$category_id)
    {
        $pdo = $this->PDO;
        $tableName = $this->tableName;
        $query = "DELETE From $tableName Where good_id = :good_id and category_id = :category_id";
        $del = $pdo->prepare($query);
        $del->execute([
            'good_id'=>$good_id,
            'category_id'=>$category_id,
        ]);
    }
    // добавление записи
    public function add($data)
    {
        if (!$this->validate($data)){
            return;
        }
        $pdo = $this->PDO;
        $tableName = $this->tableName;
        $query = "INSERT into $tableName Values (:good_id,:category_id)";
        $del = $pdo->prepare($query);
        $del->execute([
            'good_id'=>$data['good_id'],
            'category_id'=>$data['category_id'],
        ]);
    }
    // имя таблицы
    protected function getTableName(){
        return $this->tableName;
    }
    // валидация
    protected function validate($data){
        foreach ($data as $key => &$value){
            $value = trim($value);
        }
        if ((new Goods)->getInstanse($data['good_id'])==false){
            return false;
        }
        if ((new Category)->getInstanse($data['category_id'])==false){
            return false;
        }
        return true;

    }
}


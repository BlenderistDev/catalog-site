<?php

require_once("goods.php");
require_once("category.php");
require_once("dbTable.php");

class GoodsCategory extends Table
{
    //получение категорий по id товара
    public static function getCategories($id)
    {
        $array=[];
        $pdo = self::getPDO();
        $tableName = static::getTableName();
        $query = "Select category_id From $tableName Where good_id = :id";
        $data = $pdo->prepare($query);
        $data->execute(['id'=>$id]);
        $data = $data->fetchAll(PDO::FETCH_ASSOC);
        foreach ($data as $value){
            $array[]=[
                'name' => Category::getInstanse($value['category_id'])['name'],
                'id' => $value['category_id'],
            ];
        }
        return $array;
    }
    //получение товаров по id категории
    public static function getGoods($id)
    {
        $array=[];
        $pdo = self::getPDO();
        $tableName = static::getTableName();
        $query = "Select good_id From $tableName Where category_id = :id";
        $data = $pdo->prepare($query);
        $data->execute(['id'=>$id]);
        $data = $data->fetchAll(PDO::FETCH_ASSOC);
        foreach ($data as $value){
            $array[]=[
                'name' => Goods::getInstanse($value['good_id'])['name'],
                'id' => $value['good_id'],
            ];
        }
        return $array;
    }
    // удаление записи
    public static function del($good_id,$category_id)
    {
        $pdo = self::getPDO();
        $tableName = static::getTableName();
        $query = "DELETE From $tableName Where good_id = :good_id and category_id = :category_id";
        $del = $pdo->prepare($query);
        $del->execute([
            'good_id'=>$good_id,
            'category_id'=>$category_id,
        ]);
    }
    // добавление записи
    public static function add($data)
    {
        if (!self::validate($data)){
            return;
        }
        $pdo = self::getPDO();
        $tableName = static::getTableName();
        $query = "INSERT into $tableName Values (:good_id,:category_id)";
        $del = $pdo->prepare($query);
        $del->execute([
            'good_id'=>$data['good_id'],
            'category_id'=>$data['category_id'],
        ]);
    }
    // имя таблицы
    protected static function getTableName(){
        return "goods_category";
    }
    // валидация
    protected static function validate($data){
        foreach ($data as $key => &$value){
            $value = trim($value);
        }
        if (Goods::getInstanse($data['good_id'])==false){
            return false;
        }
        if (Category::getInstanse($data['category_id'])==false){
            return false;
        }
        return true;

    }
}


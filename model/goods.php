<?php

require_once("model\catalog.php");

class Goods extends Catalog{
    protected $tableName;

    public function __construct(){
        parent::__construct();
        $this->tableName = "goods";
    }
    protected function getTableName()
    {
        return $this->tableName;
    }
    // добавление в таблицу
    public function add($post)
    {
        list($post,$errors)=$this->validate($post);
        if ($errors!==[]){
            return $errors;
        }
        $query= "INSERT INTO goods VALUES (NULL, :name, :summary, :fullSummary, :activity, :amount, :booking)"; 
        $add = $this->PDO->prepare($query);
        $add->execute([
            'name' => $post['name'],
            'summary'=>$post['summary'],
            'fullSummary'=>$post['fullSummary'],
            'activity'=>$post['activity'],
            'amount'=>$post['amount'],
            'booking'=>$post['booking'],
        ]);
        return false;
    }
    // изменение елемента таблицы
    public function edit($post)
    {
        $id = $post['id'];
        list($post,$errors)=$this->validate($post);
        if ($errors!==[]){
            return $errors;
        }
        $query ="Update goods set name = :name,summary = :summary,fullSummary = :fullSummary, activity = :activity,amount = :amount,booking = :booking WHERE id = :id";
        $edit = $this->PDO->prepare($query);
        $edit->execute([
            'id' => $id,
            'name' => $post['name'],
            'summary'=>$post['summary'],
            'fullSummary'=>$post['fullSummary'],
            'activity'=>$post['activity'],
            'amount'=>$post['amount'],
            'booking'=>$post['booking'],
        ]);
        return false;
    }
    // валидация
    protected function validate($post)
    {
        $errors =[];
        $args = [
            'name'=>FILTER_SANITIZE_STRING,
            'summary'=>FILTER_SANITIZE_STRING,
            'fullSummary'=>FILTER_SANITIZE_STRING,
            'activity'=>FILTER_VALIDATE_INT,
            'amount'=>FILTER_VALIDATE_INT,
            'booking'=>FILTER_VALIDATE_INT,
        ];
        $post = filter_var_array($post, $args);
        foreach($post as &$value){
            $value = trim($value);
        }
        if (strlen($post['name'])<3){
            $errors[]="некорректное имя";
        }
        if ($post['activity']===''){
            $errors[]="некорректная активность";
        }
        if ($post['amount']===''){
            $errors[]="некорректное количество";
        }
        if ($post['booking']===''){
            $errors[]="некорректная возможность заказа";
        }
        return [$post,$errors];
    }
    // public static function getFilterData($filters)
    // {
    //     // фильтруем по количеству
    //     if(!isset($filter['amoutStart'])){
    //         $filter['amoutStart'] = 0;
    //     }
    //     if(!isset($filter['amoutEnd'])){
    //         $filter['amoutEnd'] = null;
    //     }

    //     // фильтруем по количеству
    //     if(!isset($filter['booking'])){
    //         $filter['booking'] = null;
    //     }
    //     elseif($filter['booking']>1){
    //         $filter['booking'] = 1;
    //     }

    //     if (!isset($filter['name'])){
    //         $filter['name'] = null;
    //     }

    //     if (!isset($filter['']))
    // }



}

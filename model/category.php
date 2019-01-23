<?php

class Category extends Catalog
{
    protected $tableName;

    public function __construct(){
        parent::__construct();
        $this->tableName = "category";
    }
    protected function getTableName(){
        return $this->tableName;
    }
    // добавление в таблицу
    public function add($post){
        list($post,$errors)=$this->validate($post);
        if ($errors!==[]){
            return $errors;
        }
        $query= "INSERT INTO category VALUES (NULL, :name, :summary, :fullSummary, :activity)"; 
        $add = $this->PDO->prepare($query);
        $add->execute([
            'name' => $post['name'],
            'summary'=>$post['summary'],
            'fullSummary'=>$post['fullSummary'],
            'activity'=>$post['activity'],
        ]);
        return false;
    }
    // изменение елемента таблицы
    public function edit($post){
        $id = $post['id'];
        list($post,$errors)=$this->validate($post);
        if ($errors!==[]){
            return $errors;
        }
        $query ="Update category set name = :name,summary = :summary,fullSummary = :fullSummary, activity = :activity WHERE id = :id";
        $edit = $this->PDO->prepare($query);
        $edit->execute([
            'id' => $id,
            'name' => $post['name'],
            'summary'=>$post['summary'],
            'fullSummary'=>$post['fullSummary'],
            'activity'=>$post['activity'],
        ]);
        return false;
    }
    // валидация
    protected function validate($post){
        $errors =[];
        $args = [
            'name'=>FILTER_SANITIZE_STRING,
            'summary'=>FILTER_SANITIZE_STRING,
            'fullSummary'=>FILTER_SANITIZE_STRING,
            'activity'=>FILTER_VALIDATE_INT,
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
        return [$post,$errors];
    }

}
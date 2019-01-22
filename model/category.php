<?php

class Category extends Catalog
{
    protected static function getTableName(){
        return "category";
    }
    // добавление в таблицу
    public static function add($post){
        list($post,$errors)=self::validate($post);
        if ($errors!==[]){
            return $errors;
        }
        $query= "INSERT INTO category VALUES (NULL, :name, :summary, :fullSummary, :activity)"; 
        $add = self::getPDO()->prepare($query);
        $add->execute([
            'name' => $post['name'],
            'summary'=>$post['summary'],
            'fullSummary'=>$post['fullSummary'],
            'activity'=>$post['activity'],
        ]);
        return false;
    }
    // изменение елемента таблицы
    public static function edit($post){
        $id = $post['id'];
        list($post,$errors)=self::validate($post);
        if ($errors!==[]){
            return $errors;
        }
        $query ="Update category set name = :name,summary = :summary,fullSummary = :fullSummary, activity = :activity WHERE id = :id";
        $edit = self::getPDO()->prepare($query);
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
    protected static function validate($post){
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
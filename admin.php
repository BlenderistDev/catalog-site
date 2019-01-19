<?php
// точка входа Админа
require_once('adminController.php');

$redirect = false;
$controller = new AdminController();
$post=$_POST;
$get =$_GET;
$oldget =[];
// соединяем старых и новый get запросы
if (isset($_SERVER['HTTP_REFERER']) && count($post)==0){
    $old = parse_url($_SERVER['HTTP_REFERER']);
    if (isset($old['query'])){
        if(strpos($old['query'],"&"))
            $old = explode("&",$old['query']);
        else{
            $old=[$old['query']];
        }
        for ($i=0; $i<count($old); $i++){
            $newold = explode("=",$old[$i]);
            $oldget[$newold[0]]=$newold[1];
        }
    }
    foreach($oldget as $key=>$value){
        if (isset($get[$key])){}
        else{
            $get[$key]=$value;
            $redirect = true;
        }
    }
}
// переадресуем, в случае если get запрос был изменен
if ($redirect){
    $path = parse_url($_SERVER['REQUEST_URI'])['path'];
    $url = $path."?";
    $flag = false;
    foreach($get as $key => $value){
        if ($flag){
            $url.="&";
        }
        $flag =true;
        $url.="$key=$value";
    }
    header("location: $url");
}
// в post-параметре act хранится действие контроллера
if(isset($post['act'])){
    $action = ($post['act']);
    $controller->$action();
}
else{
    $controller->index();
}

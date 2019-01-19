<?php
// абстракция контроллера
abstract class Controller{
    protected const GOODS_PAGE_PROPERTY = "goodsPage";//get-своство для хранения номера страницы таблицы товаров
    protected const CATEGORY_PAGE_PROPERTY = "categoryPage";//get-своство для хранения номера страницы таблицы категорий

    protected static $goodsPagination = 5;//количество елементов на странице для товаров
    protected static $categoryPagination = 5;//количество елементов на странице для категорий

    //рендер страницы
    protected function render($file,$data = [])
    {
        foreach ($data as $key =>$value){
            $$key = $value;
        }
        include($file);
    }
    //разбиение по страницам
    protected function getPagination($data,$count,$propName)
    {
        $pageCount = ceil(count($data)/$count);
        if (isset($_GET[$propName])){
            $page = $_GET[$propName];
        }
        else{
            $page = 1;
        }
        $data=array_splice($data,$page*$count-$count,$count);
        return [$data,$pageCount];
    }
    //получение get параметров предыдущего запроса
    protected function checkGet()
    {
        $oldget =[];
        if(isset($_SERVER['HTTP_REFERER'])){
            $getStr = parse_url($_SERVER['HTTP_REFERER']);
            if (isset($getStr['query'])){
                if(strpos($getStr['query'],"&"))
                    $getStr = explode("&",$getStr['query']);
                else{
                    $getStr=[$getStr['query']];
                }
                for ($i=0; $i<count($getStr); $i++){
                    $newold = explode("=",$getStr[$i]);
                    $oldget[$newold[0]]=$newold[1];
                }
            }
        }
        return $oldget;
    }
    //кнопка закрыть
    public function close()
    {
        header("location: $_SERVER[REQUEST_URI]");
    }
    abstract public function index($get);

}
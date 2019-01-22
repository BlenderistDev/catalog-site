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
    //кнопка закрыть
    public function close()
    {
        header("location: $_SERVER[REQUEST_URI]");
    }
    abstract public function index();

    // установка get-значений по умолчанию
    protected function getGet(){
        $get = [];
        foreach($_GET as $key => $value){
            $get[$key]=$value;
        }
        // если страница товаров не выбрана, ставим первую
        if (!isset($get[self::GOODS_PAGE_PROPERTY])){
            $get[self::GOODS_PAGE_PROPERTY] = 1;
        }
        // если страница категорий не выбрана, ставим первую
        if (!isset($get[self::CATEGORY_PAGE_PROPERTY])){
            $get[self::CATEGORY_PAGE_PROPERTY] = 1;
        }
        // по умолчанию показываем все товары
        if (!isset($get['active'])){
            $get['active'] = false;
        }
        return $get;
    }

}
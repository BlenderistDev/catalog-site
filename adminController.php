<?php

require_once("controller.php");
require_once("goods.php");
require_once("category.php");
require_once("goodsCategory.php");

class AdminController extends Controller
{
    public function index($get = [])
    {
        //получение get параметров предыдущего запроса
        if ($get === []){
            $get = $_GET;
        }
        //данные по товарам
        if (isset($get['active']) && ($get['active']==='true')){//проверяем условие о показе только активных товаров
            $goodsData = Goods::getActiveData();
        }else{
            $goodsData = Goods::getData();
        }
        list($goodsData,$goodsPageCount)=$this->getPagination($goodsData,self::$goodsPagination,self::GOODS_PAGE_PROPERTY);
        //данные по категориям
        $categoryData = Category::getData();
        list($categoryData,$categoryPageCount)=$this->getPagination($categoryData,self::$categoryPagination,self::CATEGORY_PAGE_PROPERTY);
        //рендерим страницу
        $this->render('admin/index.php',[
            'goodsPageCount' => $goodsPageCount,
            'goodsData'=>$goodsData,
            'categoryPageCount' => $categoryPageCount,
            'categoryData'=>$categoryData,
        ]);
        //проверка get параметра act
        if (isset($get['act'])){
            switch ($get['act']){
                case 'showGood':
                    $id = $get['id'];
                    $good = Goods::getInstanse($id);
                    $categories = GoodsCategory::getCategories($id);
                    $this->render('admin/showGood.php',[
                        'goodData' => $good,
                        'categories'=>$categories,
                        'categoryList'=>Category::getList(),
                    ]);
                break;
                case 'showCategory':
                    $id = $_GET['id'];
                    $category = Category::getInstanse($id);
                    $goods = GoodsCategory::getGoods($id);
                    $this->render('admin/showCategory.php',[
                        'CategoryData' => $category,
                        'goods'=>$goods,
                    ]);
                break;
            }
        }
    }
    // форма добавления товара
    public function addGoods($errors = [])
    {
        $this->index($this->checkGet());
        $this->render('admin/goodsAdd.php',[
            'errors'=>$errors,
        ]);
    }
    // добавление нового товара
    public function addNewGood()
    {
        $post = $_POST;
        if($errors = Goods::add($post)){
            $this->addGoods($errors);
        }
        else{
            $this->index($this->checkGet());
        }
    }
    //форма изменения товара
    public function EditGoods($errors = [])
    {
        $post = $_POST;
        $this->index($this->checkGet());
        $this->render('admin/goodsEdit.php',[
            'data'=>$post,
            'errors'=>$errors,
        ]);
    }
    //изменение товара
    public function EditGood()
    {
        $post = $_POST;
        if($errors = Goods::edit($post)){
            $this->editGoods($errors);
        }
        else{
            $this->index($this->checkGet());
        }
    }
    // форма добавления категории
    public function addCategory($errors = [])
    {
        $this->index($this->checkGet());
        $this->render('admin/categoryAdd.php',[
            'errors'=>$errors,
        ]);
    }
    // добавление новой категории
    public function addNewCategory()
    {
        $post = $_POST;
        if($errors = Category::add($post)){
            $this->addCategory($errors);
        }
        else{
            $this->index($this->checkGet());
        }
    }
    // форма изменения категории
    public function EditCategories($errors = [])
    {
        $post = $_POST;
        $this->index($this->checkGet());
        $this->render('admin/categoryEdit.php',[
            'data'=>$post,
            'errors'=>$errors,
        ]);
    }
    // изменение категории
    public function EditCategory()
    {
        $post = $_POST;
        if($errors = Category::edit($post)){
            $this->EditCategories($errors);
        }
        else{
            $this->index($this->checkGet());
        }
    }
    // удаление категории товара
    public function delGoodCategory()
    {
        $post = $_POST;
        GoodsCategory::del($post['good_id'],$post['category_id']);
        $this->index($this->checkGet());
    }
    // добавление категории товара
    public function addCategory2Good()
    {
        $post = $_POST;
        GoodsCategory::add($post);
        $this->index($this->checkGet());
    }

}
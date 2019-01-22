<?php

require_once("controller\controller.php");
require_once("model\goods.php");
require_once("model\category.php");
require_once("model\goodsCategory.php");
require_once("helper\paginator.php");

class AdminController extends Controller
{
    public function index()
    {
        $get = self::getGet($_GET);
        //данные по товарам
        if ($get['active']==='true'){//проверяем условие о показе только активных товаров
            $goodsData = Goods::getActiveData();
        }else{
            $goodsData = Goods::getData();
        }
        $goodsData = new Paginator($goodsData,self::$goodsPagination);
        $goodsPageCount = $goodsData->getPageCount();
        $goodsData = $goodsData->getPage($get['goodsPage']);
        //данные по категориям
        $categoryData = Category::getData();
        $categoryData = new Paginator($categoryData,self::$categoryPagination);
        $categoryPageCount = $categoryData->getPageCount();
        $categoryData = $categoryData->getPage($get['categoryPage']);
        //рендерим страницу
        $this->render('index',[
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
                    $this->render('showGood',[
                        'goodData' => $good,
                        'categories'=>$categories,
                        'categoryList'=>Category::getList(),
                    ]);
                break;
                case 'showCategory':
                    $id = $get['id'];
                    $category = Category::getInstanse($id);
                    $goods = GoodsCategory::getGoods($id);
                    $this->render('showCategory',[
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
        $this->index();
        $this->render('goodsAdd',[
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
            $this->index();
        }
    }
    //форма изменения товара
    public function EditGoods($errors = [])
    {
        $post = $_POST;
        $this->index();
        $this->render('goodsEdit',[
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
            $this->index();
        }
    }
    // форма добавления категории
    public function addCategory($errors = [])
    {
        $this->index();
        $this->render('categoryAdd',[
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
            $this->index();
        }
    }
    // форма изменения категории
    public function EditCategories($errors = [])
    {
        $post = $_POST;
        $this->index();
        $this->render('categoryEdit',[
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
            $this->index();
        }
    }
    // удаление категории товара
    public function delGoodCategory()
    {
        $post = $_POST;
        GoodsCategory::del($post['good_id'],$post['category_id']);
        header("location: $_SERVER[HTTP_REFERER]");
        // $this->index($this->checkGet());
    }
    // добавление категории товара
    public function addCategory2Good()
    {
        $post = $_POST;
        GoodsCategory::add($post);
        header("location: $_SERVER[HTTP_REFERER]");
        // $this->index($this->checkGet());
    }
    static protected function getControllerName()
    {
        return "admin";
    }

}
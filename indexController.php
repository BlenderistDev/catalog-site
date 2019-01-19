<?php

require_once("controller.php");
require_once("goods.php");
require_once("category.php");
require_once("goodsCategory.php");

class IndexController extends Controller
{
 
    public function index($get = []){
        //получение get параметров предыдущего запроса
        if ($get === []){
            $get = $_GET;
        }
        //данные по товарам
        $goodsData = Goods::getActiveData();
        list($goodsData,$goodsPageCount)=$this->getPagination($goodsData,self::$goodsPagination,self::GOODS_PAGE_PROPERTY);
        //данные по категориям
        $categoryData = Category::getActiveData();
        list($categoryData,$categoryPageCount)=$this->getPagination($categoryData,self::$categoryPagination,self::CATEGORY_PAGE_PROPERTY);
        //рендерим страницу
        $this->render('index/index.php',[
            'goodsPageCount' => $goodsPageCount,
            'goodsData'=>$goodsData,
            'categoryPageCount' => $categoryPageCount,
            'categoryData'=>$categoryData,
        ]);
        //проверка get параметра act
        if (isset($_GET['act'])){
            switch ($_GET['act']){
            case 'showGood':
                $id = $_GET['id'];
                $good = Goods::getInstanse($id);
                $categories = GoodsCategory::getCategories($id);
                $this->render('index/showGood.php',[
                    'goodData' => $good,
                    'categories'=>$categories,
                ]);
                break;
            case 'showCategory':
                $id = $_GET['id'];
                $category = Category::getInstanse($id);
                $goods = GoodsCategory::getGoods($id);
                $this->render('index/showCategory.php',[
                    'CategoryData' => $category,
                    'goods'=>$goods,
                ]);
                break;
            }
        }
    }
    // поиск товара по id
    public function findGood()
    {
        $post = $_POST;
        $id = strip_tags(trim($post['id']));
        $good = Goods::getInstanse($id);
        if ($good==false){
            $this->render('404.php');
        }
        else{
            $categories = GoodsCategory::getCategories($id);
            $this->render('index/showGoodSep.php',[
                'goodData' => $good,
                'categories'=>$categories,
            ]);
        }
    }
}
<?php

require_once("controller.php");
require_once("goods.php");
require_once("category.php");
require_once("goodsCategory.php");
require_once("paginator.php");

class IndexController extends Controller
{
 
    public function index()
    {
        $get = self::getGet($_GET);
        //данные по товарам
        $goodsData = Goods::getActiveData();
        $goodsData = new Paginator($goodsData,self::$goodsPagination);
        $goodsPageCount = $goodsData->getPageCount();
        $goodsData = $goodsData->getPage($get['goodsPage']);
        //данные по категориям
        $categoryData = Category::getActiveData();
        $categoryData = new Paginator($categoryData,self::$categoryPagination);
        $categoryPageCount = $categoryData->getPageCount();
        $categoryData = $categoryData->getPage($get['categoryPage']);
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
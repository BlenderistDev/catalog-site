<?php

require_once("controller\controller.php");
require_once("model\goods.php");
require_once("model\category.php");
require_once("model\goodsCategory.php");
require_once("helper\paginator.php");

class IndexController extends Controller
{
 
    public function index()
    {
        $get = self::getGet($_GET);
        //данные по товарам
        $goodsData = (new Goods)->getActiveData();
        $goodsData = new Paginator($goodsData,self::$goodsPagination);
        $goodsPageCount = $goodsData->getPageCount();
        $goodsData = $goodsData->getPage($get['goodsPage']);
        //данные по категориям
        $categoryData = (new Category)->getActiveData();
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
        if (isset($_GET['act'])){
            switch ($_GET['act']){
            case 'showGood':
                $id = $_GET['id'];
                $good = (new Goods)->getInstanse($id);
                $categories = (new GoodsCategory)->getCategories($id);
                $this->render('showGood',[
                    'goodData' => $good,
                    'categories'=>$categories,
                ]);
                break;
            case 'showCategory':
                $id = $_GET['id'];
                $category = (new Category)->getInstanse($id);
                $goods = (new GoodsCategory)->getGoods($id);
                $this->render('showCategory',[
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
        $good = (new Goods)->getInstanse($id);
        if ($good==false){
            $this->render('404');
        }
        else{
            $categories = (new GoodsCategory)->getCategories($id);
            $this->render('showGoodSep',[
                'goodData' => $good,
                'categories'=>$categories,
            ]);
        }
    }
    static protected function getControllerName()
    {
        return "index";
    }
}
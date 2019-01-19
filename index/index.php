<?php
// css файл
print "<link rel='stylesheet' type='text/css' href='admin.css' />";
// таблица товаров
$this->render('header.php');
print "<div class = \"content\">";
print "<div class = \"tables\">";
$this->render('index/goodsTable.php',[
    'goodsData'=>$goodsData,
    'goodsPageCount' => $goodsPageCount,
]);
// таблица категорий
print "<br>";
$this->render('index/categoryTable.php',[
    'categoryData'=>$categoryData,
    'categoryPageCount' => $categoryPageCount,
]);
print("</div>");


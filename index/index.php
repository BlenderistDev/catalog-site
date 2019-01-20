
<!-- css файл -->
<link rel='stylesheet' type='text/css' href='admin.css' />
<?php
// таблица товаров
$this->render('header.php');
?>
<div class = "content">
<div class = "tables">
<?php
$this->render('index/goodsTable.php',[
    'goodsData'=>$goodsData,
    'goodsPageCount' => $goodsPageCount,
]);
?>
<br>
<?php
// таблица категорий
$this->render('index/categoryTable.php',[
    'categoryData'=>$categoryData,
    'categoryPageCount' => $categoryPageCount,
]);
?>
</div>


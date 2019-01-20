<!-- css файл -->
<link rel='stylesheet' type='text/css' href='admin.css'/>
<?php
// таблица товаров
$this->render('header.php');
?>
<div class = "content">
<div class = "tables">
<?php
$this->render('admin/goodsTable.php',[
    'goodsData'=>$goodsData,
    'goodsPageCount' => $goodsPageCount,
]);
?>
<!-- таблица категорий -->
<br>
<?php
$this->render('admin/categoryTable.php',[
    'categoryData'=>$categoryData,
    'categoryPageCount' => $categoryPageCount,
]);
?>
</div>




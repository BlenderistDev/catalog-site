<!-- css файл -->
<link rel='stylesheet' type='text/css' href='admin.css'/>
<div class = "content">
<div class = "tables">
<?php
// таблица товаров
$this->render('goodsTable',[
    'goodsData'=>$goodsData,
    'goodsPageCount' => $goodsPageCount,
]);
?>
<!-- таблица категорий -->
<br>
<?php
$this->render('categoryTable',[
    'categoryData'=>$categoryData,
    'categoryPageCount' => $categoryPageCount,
]);
?>
</div>




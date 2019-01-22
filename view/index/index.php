
<!-- css файл -->
<link rel='stylesheet' type='text/css' href='admin.css' />
<div class = "content">
<div class = "tables">
<?php
// таблица товаров
$this->render('goodsTable',[
    'goodsData'=>$goodsData,
    'goodsPageCount' => $goodsPageCount,
]);
?>
<br>
<?php
// таблица категорий
$this->render('categoryTable',[
    'categoryData'=>$categoryData,
    'categoryPageCount' => $categoryPageCount,
]);
?>
</div>


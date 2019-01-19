<?php
// $goodData - данные по товару
// $categories - категории, к которым относится товар
print<<<_HTML_
<div class = "showGood">
Id: $goodData[id]<br>
Название: $goodData[name]<br>
Описание: $goodData[summary]<br>
Полное описание: $goodData[fullSummary]<br>
Количество: $goodData[amount]<br>
Активность: $goodData[activity]<br>
Под заказ: $goodData[booking]<br>
Категории:<br>
<table>
_HTML_;
foreach($categories as $value){
    print "<a href=\"index.php?act=showCategory&id=$value[id]\">$value[name]</a>, ";
}
print "<br>";
print "<a href=index.php>закрыть</a>";
print "</div>";
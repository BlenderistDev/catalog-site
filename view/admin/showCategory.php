<?php
// $CategoryData - данные по категории
// $goods - товары из категории
print<<<_HTML_
<div class ="showCategory">
Название: $CategoryData[name]<br>
Описание: $CategoryData[summary]<br>
Полное описание: $CategoryData[fullSummary]<br>
Товары:<br>
_HTML_;
foreach($goods as $value){
    print "<a href=\"admin.php?act=showGood&id=$value[id]\">$value[name]</a>, ";
}
?>
<br>
</div>
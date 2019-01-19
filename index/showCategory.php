<?php
// $CategoryData - данные по категории
// $goods - товары из категории
print "<div class =\"showCategory\">";
print "Название: $CategoryData[name]<br>";
print "Описание: $CategoryData[summary]<br>";
print "Полное описание: $CategoryData[fullSummary]<br>";
print "товары:<br>";
foreach($goods as $value){
    print "<a href=\"index.php?act=showGood&id=$value[id]\">$value[name]</a>, ";
}
print "<br>";

print "</div>";
<div class = "goodsTable">
<table><thead><td>id</td><td>Название</td><td>Описание</td><td>Количество</td><td>Заказ</td></thead>
<?php
// $categoryData - массив данных товаров
// $categoryPageCount - количество страниц
$foot = "<form method=\"get\" action =\"index.php\">";
for ($i=1;$i<$goodsPageCount+1;$i++){
    $foot.="<button name=\"goodsPage\" value=\"$i\">$i</button>";
}
$foot .= "</form>";
foreach ($goodsData as $key => $value){
    $name = "<a href=\"index.php?act=showGood&id=$value[id]\">$value[name]</a>";
    print<<<_HTML_
    <tr>
    <td>$value[id]</td><td>$name</td><td>$value[summary]</td><td>$value[amount]</td><td>$value[booking]</td>
    </tr>
_HTML_;
}
print<<<_HTML_
</table>
$foot
Поиск по ID <form method ="post" action = "index.php"><input type = "text" name = "id"><button name = "act" value ="findGood">Найти</form>
</div>
_HTML_;

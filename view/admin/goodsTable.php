<?php
// $categoryData - массив данных товаров
// $categoryPageCount - количество страниц
$button = "<form method = \"post\" action = \"admin.php\"><button name=\"act\" value=\"addGoods\">+</button></form>";
print "<span class = \"goodsTable\">
    <table><thead><td>id</td><td>Название</td><td>Описание</td><td>Активность</td><td>Количество</td><td>Заказ</td><td>$button</td></thead>";
$foot = "<form method=\"get\" action =\"admin.php\">";
for ($i=1;$i<$goodsPageCount+1;$i++){
    $foot.="<button name=\"goodsPage\" value=\"$i\">$i</button>";
}
$foot .= "</form>";
foreach ($goodsData as $key => $value){
    $editButton = "<form method = \"post\" action = \"admin.php\"><button name=\"act\" value=\"editGoods\">edit</button>";
    $editButton .="<input type=\"hidden\" name =\"id\" value =\"$value[id]\">";
    $editButton .="<input type=\"hidden\" name =\"name\" value =\"$value[name]\">";
    $editButton .="<input type=\"hidden\" name =\"summary\" value =\"$value[summary]\">";
    $editButton .="<input type=\"hidden\" name =\"fullSummary\" value =\"$value[fullSummary]\">";
    $editButton .="<input type=\"hidden\" name =\"activity\" value =\"$value[activity]\">";
    $editButton .="<input type=\"hidden\" name =\"amount\" value =\"$value[amount]\">";
    $editButton .="<input type=\"hidden\" name =\"booking\" value =\"$value[booking]\">";
    $editButton.="</form>";
    $name = "<a href=\"admin.php?act=showGood&id=$value[id]\">$value[name]</a>";
    print<<<_HTML_
    <tr>
    <td>$value[id]</td><td>$name</td><td>$value[summary]</td><td>$value[activity]</td><td>$value[amount]</td><td>$value[booking]</td><td>$editButton</td>
    </tr>
_HTML_;
}
print "</table> $foot 
    <form method=\"get\" action =\"admin.php\"><button name = \"active\" value = \"true\">Только активные</button><button name = \"active\" value = \"false\">все</button></form>
    <form method=\"get\" action=\"admin.php\">
    Имя: <input type =\"text\" name = \"name\" value =\"$goodsFilterForm[name]\"><br>
    Количество: от <input type= \"text\" name =\"amountStart\" value =\"$goodsFilterForm[amountStart]\"> до <input type=\"text\" name =\"amountEnd\" value =\"$goodsFilterForm[amountEnd]\"><br>
    Активность: <input type = \"checkbox\" name = \"activity\" value =\"$goodsFilterForm[activity]\"><br>
    Заказ: <input type = \"checkbox\" name = \"booking\" value =\"$goodsFilterForm[booking]\"><br>
    <input type = \"submit\" value = \"применить\">
    </form>
    <form method=\"get\" action=\"admin.php\">
    <input type = \"submit\" value = \"сбросить\">
    <input type =\"hidden\" name = \"name\"><br>
    <input type= \"hidden\" name =\"amountStart\"><input type=\"hidden\" name =\"amountEnd\"><br>
    <input type = \"hidden\" name = \"activity\" value = \"0\"><br>
    <input type = \"hidden\" name = \"booking\" value = \"0\"><br>
    </form>
    </span>";
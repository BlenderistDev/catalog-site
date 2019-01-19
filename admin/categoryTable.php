<?php
// $categoryData - массив данных категорий
// $categoryPageCount - количество страниц
print "<span class=\"categoryTable\">";
$button = "<form method = \"post\" action = \"admin.php\"><button name=\"act\" value=\"addCategory\">+</button></form>";
print "<table><thead><td>id</td><td>Название</td><td>Описание</td><td>Активность</td><td>$button</td></thead>";
$foot = "<form method=\"get\" action =\"admin.php\">";
for ($i=1;$i<$categoryPageCount+1;$i++){
    $foot.="<button name=\"categoryPage\" value=\"$i\">$i</button>";
}
$foot .= "</form>";
foreach ($categoryData as $key => $value){
    $editButton = "<form method = \"post\" action = \"admin.php\"><button name=\"act\" value=\"editCategories\">edit</button>";
    $editButton .="<input type=\"hidden\" name =\"id\" value =\"$value[id]\">";
    $editButton .="<input type=\"hidden\" name =\"name\" value =\"$value[name]\">";
    $editButton .="<input type=\"hidden\" name =\"summary\" value =\"$value[summary]\">";
    $editButton .="<input type=\"hidden\" name =\"fullSummary\" value =\"$value[fullSummary]\">";
    $editButton .="<input type=\"hidden\" name =\"activity\" value =\"$value[activity]\">";
    $editButton.="</form>";
    $name = "<a href=\"admin.php?act=showCategory&id=$value[id]\">$value[name]</a>, ";
    print<<<_HTML_
    <tr>
    <td>$value[id]</td><td>$name</td><td>$value[summary]</td><td>$value[activity]</td><td>$editButton</td>
    </tr>
_HTML_;
}
print "</table>";
print $foot;
print "</span>";
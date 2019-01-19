<?php
// $categoryData - массив данных категорий
// $categoryPageCount - количество страниц
print "<div class=\"categoryTable\">";
print "<table><thead><td>id</td><td>Название</td><td>Описание</td></thead>";
$foot = "<form method=\"get\" action =\"index.php\">";
for ($i=1;$i<$categoryPageCount+1;$i++){
    $foot.="<button name=\"categoryPage\" value=\"$i\">$i</button>";
}
$foot .= "</form>";
foreach ($categoryData as $key => $value){
    $name = "<a href=\"index.php?act=showCategory&id=$value[id]\">$value[name]</a>, ";
    print<<<_HTML_
    <tr>
    <td>$value[id]</td><td>$name</td><td>$value[summary]</td>
    </tr>
_HTML_;
}
print "</table>";
print $foot;
print "</div>";
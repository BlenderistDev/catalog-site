<?php
// $goodData - данные по товару
// $categories - категории, к которым относится товар
// $categoryList -список всех категорий
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
    print "<tr>
    <td>$value[name]</td>
    <td>
    <form method = \"Post\" action = \"admin.php\" class = \"categoryDel\">
    <input type = \"hidden\" name = \"good_id\" value = \"$goodData[id]\">
    <input type = \"hidden\" name = \"category_id\" value = \"$value[id]\">
    <button name = \"act\" value = \"delGoodCategory\" class = \"categoryDel\">X</button></form>
    </td>
    </tr>";
}
?>
<br>
<form  method = "post" action = "admin.php"><select name ="category_id">
<?php
foreach($categoryList as $value){
    print "<option value =\"$value[id]\">$value[name]</option>";
}
?>
</select><input type="hidden" name="good_id" value ="$goodData[id]"><button name ="act" value="addCategory2Good">добавить</button></form>
</table>
</div>
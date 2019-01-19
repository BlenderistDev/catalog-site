<!-- $errors - массив ошибок -->
<div class = "goodsAdd">
    <form method = "post" action = "admin.php">
        <table>
            <tfoot><td><button name = "act" value = "addNewGood">Добавить</button></td><td><button name = "act" value = "close">Закрыть</button></td></tfoot>
        <tr><td>Название:</td><td><input type="text" name = "name"></td></tr>
        <tr><td>Краткое описание:</td><td><input type="text" name = "summary"></td></tr>
        <tr><td>Полное описание:</td><td><input type="text" name = "fullSummary"></td></tr>
        <tr><td>Активность:</td><td><input type="text" name = "activity"></td></tr>
        <tr><td>Количество:</td><td><input type="text" name = "amount"></td></tr>
        <tr><td>Под заказ:</td><td><input type="text" name = "booking"></td></tr>

    </form>
<?php
    if($errors!==[]){
        foreach($errors as $value){
            print "$value<br>";
        }
    }
?>
</div>
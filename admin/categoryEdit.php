<!-- $errors - массив ошибок -->
<!-- $data - массив данных по категории для автозаполнения -->
<div class = "categoryEdit">
    <form method = "post" action = "admin.php">
        <table>
            <tfoot><td><button name = "act" value = "editCategory">Изменить</button></td><td><button name = "act" value = "close">Закрыть</button></td></tfoot>
            <tr><td>Название:</td><td><input type="text" name = "name" value = "<?=$data['name']?>"></td></tr>
            <tr><td>Краткое описание:</td><td><input type="text" name = "summary" value = "<?=$data['summary']?>"></td></tr>
            <tr><td>Полное описание:</td><td><input type="text" name = "fullSummary" value = "<?=$data['fullSummary']?>"></td></tr>
            <tr><td>Активность:</td><td><input type="text" name = "activity" value = "<?=$data['activity']?>"></td></tr>
        </table>
        <input type ="hidden" name = "id" value = "<?=$data['id']?>">
    </form>
    <?php
    if($errors!==[]){
        foreach($errors as $value){
            print "$value<br>";
        }
    }
?>
</div>
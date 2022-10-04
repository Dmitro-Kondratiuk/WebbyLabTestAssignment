<?php
require_once "../config/connect.php";
$copy = R::findAll('info');
$title =$_POST['title'];
$stars = $_POST['stars'];
$release_year = $_POST['release_year'];
$error =[];
$flag = 0;
$dropdown = ['DVD','VHS','Blu-Ray'];
if($_SERVER['REQUEST_METHOD']=='POST'){
    if ($title){
        foreach ($copy as $v){
           if($title== $v['title']){
               $error['title'] = "<small style='color: red'>A file with the same name already exists</small>";
           }
        }
    }
    if(!$title){
        $error['title'] = "<small style='color: red'>Required input field</small>";
    }

    if($release_year < 1850 ){
        $error['release_year'] = "<small style='color: red'>Enter a creation date between 1850 and 2022</small>";
    }
    if($release_year > 2023 ){
        $error['release_year'] = "<small style='color: red'>Enter a creation date between 1850 and 2022</small>";
    }
    if(!$stars){
        $error['stars'] = "<small style='color: red'>Required input field</small>";
    }
    if(empty($error)){
        $ar = [strip_tags($_POST['title']), $_POST['release_year'],$_POST['select'],strip_tags($_POST['stars'])];
        $item = R::dispense('info');
        $item->title = $ar[0];
        $item->release_year = $ar[01];
        $item->format =$ar[2];
        $item->stars = $ar[3];
        R::store($item) ;
        echo "<span style='color: green'>Recording $ar[0] was successfully added</span>";
    }
}



?>

<!doctype html>
<html lang="en">
<head>
    <title>Create</title>
</head>
<body>
<form action="create.php" method="post">
    <label>Title</label><br>
    <textarea name="title" id="title" rows="4" cols="28"><?= $_POST['title']?></textarea>
    <br>
    <?= $error['title']?>
    <br>
    <label>Release Year</label><br>
    <input type="number" id="release_year" name="release_year" value="<?= $_POST['release_year']?>"><br>
    <?= $error['release_year']?>
    <br>
    <label>Format</label><br>
    <select name="format">
        <?php foreach ($dropdown as $item): ?>
        <option value="<?=$item?>"><?=$item?></option>
        <?php endforeach; ?>
    </select>
    <br>
    <label>Stars</label><br>
    <textarea name="stars" id="stars" rows="4" cols="28"><?=$_POST['stars']?></textarea><br>
    <?= $error['stars']?>
    <br>
    <button type="submit">Create</button>
</form>
<br>
<div>
    <button><a href="/index.php">Home</button>
</div>
</body>
</html>
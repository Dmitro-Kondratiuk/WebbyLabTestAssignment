<?php
require_once "../config/connect.php";
$item_id = $_GET['id'];
$item = R::load('info',$item_id);
$dropdown = ['DVD','VHS','Blu-Ray'];
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update:<?= $item['Title']?></title>
</head>
<body>
<form action="../vendor/update.php" method="post">
    <input type="hidden" id="title" name="id" value="<?= $item_id?>">
    <label>Title</label><br>
    <textarea name="title" id="stars"   rows="4" cols="28" ><?=$item['title']?></textarea><br>
    <label>Release Yea</label><br>
    <input type="number" id="release_yea" name="release_year" value="<?=$item['release_year']?>"><br>
    <label>Format</label>
    <select name="format">
        <?php foreach ($dropdown as $value): ?>
            <?php if($value == $item['format']): ?>
            <option value="<?=$value?>" selected><?=$value?></option>
            <?php  else:?>
            <option value="<?=$value?>"><?=$value?></option>
        <?php endif; ?>
        <?php endforeach; ?>
    </select>
    <br>
    <label>Stars</label><br>
    <textarea name="stars" id="stars"   rows="4" cols="28" ><?=$item['stars']?></textarea><br>
    <button type="submit">Update</button>
</form>
<br>
<div>
    <button><a href="/index.php">Home</button>
</div>
</body>
</html>
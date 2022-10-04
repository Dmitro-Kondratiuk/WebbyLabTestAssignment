<?php
require "../config/connect.php";
$name = $_FILES["filename"]["name"];
$data = R::findAll('info');
$id = [];
$i = 0;
$d = 0;
if(move_uploaded_file($_FILES['filename']['tmp_name'],$_SERVER['DOCUMENT_ROOT'].'/upload/'.$name)){
    $extension = pathinfo($_SERVER['DOCUMENT_ROOT'].'/upload/'.$name, PATHINFO_EXTENSION);
    if(!($extension === 'txt')){
        echo "Выбирете пожалуйста файл в txt формате<br><a href='/'>Home</a>";
        exit();
    }
    $fileContent = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/upload/'.$name);
    if(empty($fileContent)){
        echo "Вы загружаете пустой файл вернитесь к форме загрузки и выберите файл с даными  <br><a href='/'>Home</a>";
        unlink($_SERVER['DOCUMENT_ROOT'].'/upload/'.$name);
        exit();
    }
    $lines = explode("\n", $fileContent);
    $items = [];
    $currentItem = [];
    foreach ($lines as $line) {
        if (!trim($line)) {
            $items[] = $currentItem;
            continue;
        }
        $lineData = explode(':', $line);
        $columnName = trim($lineData[0]);
        $columnValue = trim($lineData[1]);
        $currentItem[$columnName] = $columnValue;
    }
    foreach ($items as $item){
        $existing = false;
        foreach ($data as $v) {
            if ($v['title'] == $item['Title']) {
                $db = R::load('info', $v['id']);
                $db->title = $item['Title'];
                $db->release_year = $item['Release Year'];
                $db->format = $item['Format'];
                $db->stars = $item['Stars'];
                R::store($db);
                $existing = true;
                $i++;
            }
        }
        if (!$existing) {
            $db = R::dispense('info');
            $db->title = $item['Title'];
            $db->release_year = $item['Release Year'];
            $db->format = $item['Format'];
            $db->stars = $item['Stars'];
            R::store($db);
            $d++;
        }
    }

    echo  "You file uploaded successful<br>";
    echo "Было обновлено : ".$i."<br>";
    echo "Было добавлено : ".$d;
}else{
    echo "Your file has not been uploaded to the server";
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Upload db</title>
</head>
<body>
<br>
<a href="/">Home</a>
</body>
</html>

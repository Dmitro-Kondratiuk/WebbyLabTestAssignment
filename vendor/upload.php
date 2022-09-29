<?php
require "../config/connect.php";
$name = $_FILES["filename"]["name"];
if(move_uploaded_file($_FILES['filename']['tmp_name'],$_SERVER['DOCUMENT_ROOT'].'/upload/'.$name)){
    $fileContent = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/upload/'.$name);
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
        $db = R::dispense('info');
        $db->title = $item['Title'];
        $db->release_year = $item['Release Year'];
        $db->format = $item['Format'];
        $db->stars = $item['Stars'];
        R::store($db);
    }
    echo  "You file uploaded successful";
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

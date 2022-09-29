<?php
require_once "../config/connect.php";

if(isset($_POST['button'])) {
    $search = explode(" ", $_POST['search']);
    $count = count($search);
    $array = [];
    $i = 0;
    foreach ($search as $key) {
        $i++;
        if ($i < $count) $array[] = "CONCAT (`title`, `stars`) LIKE '%" . $key . "%' OR "; else$array[] = "CONCAT (`title`,`stars`) LIKE '%" . $key . "%'";
    }
        $sql = "SELECT * FROM `info` WHERE " . implode("", $array);
        $query = mysqli_query($connect, $sql);
        $new_array = mysqli_fetch_all($query);

}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Search</title>
</head>
<body>
<h1 style="text-align: center">Here is what I was able to find</h1>
<?php  if(empty($new_array)):?>
<h2 style="text-align: center; color: red">Sorry no matches found</h2>
<button><a href="/">Home</a></button>
<?php else: ?>
<div>
    <table border="2">
        <thead>
        <tr style="background: blue; color: antiquewhite">
            <td>Id</td>
            <td>Title</td>
            <td>Release Yea</td>
            <td>Format</td>
            <td>Stars</td>
            <td>Update</td>
            <td>Delete</td>
        </tr>
        </thead>
        <?php foreach ($new_array as $item): ?>
        <tr>
            <td><?=$item[0]?></td>
            <td><?= $item[1] ?></td>
            <td><?= $item[2] ?></td>
            <td><?= $item[3] ?></td>
            <td><?= $item[4] ?></td>
            <td><a href="update.php?id=<?= $item[0] ?>"><p> &#x270E; </p></a></td>
            <td><a href="vendor/delete.php?id=<?= $item[0] ?>"><p style="color: red"> &#128465; </p></a></td>
        </tr>
        <?php endforeach; ?>
    </table>

</div>
    <button><a href="/">Home</a></button>
<?php endif; ?>
</body>
</html>

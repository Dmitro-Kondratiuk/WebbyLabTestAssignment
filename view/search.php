<?php
require "../config/connect.php";
$text = trim(strip_tags(stripcslashes(htmlspecialchars($_POST['search']))));

$sql = "SELECT * FROM info WHERE title LIKE '%$text%' OR stars LIKE '%$text%'";
$query =$pdo->prepare($sql);
$query->execute();
$array =$query->fetchAll();

?>

<!doctype html>
<html lang="en">
<head>
    <title>Search</title>
    <link rel="stylesheet" href="/node_modules/bootstrap/dist/css/bootstrap.css">
</head>
<body>
<h1 style="text-align: center">Here is what I was able to find</h1>
<?php  if(empty($array)):?>
<h2 style="text-align: center; color: red">Sorry no matches found</h2>
<button><a href="/">Home</a></button>
<?php else: ?>
<div>
    <table border="2" id="table-id" class="table-active">
        <thead>
        <tr style="background: blue; color: antiquewhite">
            <td>Title</td>
            <td>Release Year</td>
            <td>Format</td>
            <td>Stars</td>
            <td>Update</td>
            <td>Delete</td>
        </tr>
        </thead>
        <?php foreach ($array as $item): ?>
        <tr>
            <td><?= $item[1] ?></td>
            <td><?= $item[2] ?></td>
            <td><?= $item[3] ?></td>
            <td><?= $item[4] ?></td>
            <td><a href="update.php?id=<?= $item[0] ?>"><p> &#x270E; </p></a></td>
            <td> <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">&#128465;</button>
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Форма для удаления файла</h5>
                            <button class="btn-close" data-dismiss="modal" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            Ви точно уверены что хотите удалить эту запись?
                        </div>
                        <div class="modal-footer ">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <a href="vendor/delete.php?id=<?= $item[0] ?>"  class="btn btn-primary" >Delete</a>
                        </div>
                    </div>
                </div>
            </div>
        </tr>
        <?php endforeach; ?>
    </table>

</div>
    <button><a href="/">Home</a></button>
<?php endif; ?>
<script src='/bundle.js'></script>
</body>
</html>

<?php
require 'config/db.php';
require 'vendor/read.php';
?>

<!doctype html>
<html lang="en">
<head>
    <title>Home</title>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.css">
</head>
<body>
<?php if (!isset($_SESSION['user'])): ?>
    <a href="../view/sign_in.php">Login</a><br>
    <a href="../view/register.php">Register</a>
<?php else: ?>
<button><a href="vendor/logout.php">Logout</a></button>
<button><a href="view/create.php">Create</a></button>
    <br>
    <form action="vendor/upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="filename" accept=".txt">
        <input type="submit" value="Upload">
    </form>
<br>
<form action="view/search.php" method="POST">
    <input type="text" name="search" class="search">
    <input type="submit" name="button" value="Search">
</form>
    <?php if(!empty($items)): ?>
<table id="table-id" border="2" class="table">
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
    <?php foreach ($items as $item): ?>
        <tr>
            <td><?= $item->title ?></td>
            <td><?= $item->release_year ?></td>
            <td><?= $item->format ?></td>
            <td><?= $item->stars ?></td>
            <td><a href="view/update.php?id=<?= $item['id'] ?>"><span> &#x270E; </span></a></td>
            <td> <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">&#128465;</button>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Форма для удаления файла</h5>
                                <button class="btn-close" data-dismiss="modal" aria-label="close"></button>
                            </div>
                            <div class="modal-body">
                                Ви точно уверены что хотите удалить эту запись?
                            </div>
                            <div class="modal-footer ">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <a href="vendor/delete.php?id=<?= $item['id'] ?>"  class="btn btn-primary" >Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

    <?php else: ?>
    <h2 style="text-align: center;color: red" >No records found in the database<h2>
            <?php endif; ?>
<?php endif; ?>
<script src='bundle.js'></script>
</body>
</html>

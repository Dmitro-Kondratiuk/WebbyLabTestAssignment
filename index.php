<?php
require 'config/db.php';
require 'vendor/read.php';
?>

<!doctype html>
<html lang="en">
<head>
    <title>Home</title>
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
        <input type="file" name="filename">
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
            <td><a href="view/update.php?id=<?= $item['id'] ?>"><p> &#x270E; </p></a></td>
            <td><a href="vendor/delete.php?id=<?= $item['id'] ?>"><p style="color: red"> &#128465; </p></a></td>
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

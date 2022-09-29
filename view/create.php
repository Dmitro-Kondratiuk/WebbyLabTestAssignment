<!doctype html>
<html lang="en">
<head>
    <title>Create</title>
</head>
<body>
<form action="../vendor/create.php" method="post">
    <label>Title</label><br>
    <textarea name="title" id="title" rows="4" cols="28"></textarea><br>
    <label>Release Yea</label><br>
    <input type="number" id="release_yea" name="release_yea"><br>
    <label>Format</label><br>
    <input type="text" id="format" name="format"><br>
    <label>Stars</label><br>
    <textarea name="stars" id="stars" rows="4" cols="28"></textarea><br>
    <button type="submit">Create</button>
</form>
<br>
<div>
    <button><a href="/index.php">Home</button>
</div>
</body>
</html>
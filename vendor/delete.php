<?php
require_once "../config/connect.php";
$item_id= $_GET['id'];
$item = R::load('info',$item_id);
R::trash($item);
echo "<div style='text-align: center'>
<p style='color: red;font-size: 20px'>The item you selected has been removed</p>
</div>";
header("Refresh: 2; /");
<?php
require_once "../config/connect.php";
$item_id= $_GET['id'];
$item = R::load('info',$item_id);
R::trash($item);
header('Location:/');
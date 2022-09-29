<?php
require "../config/connect.php";

$item_id = $_GET['id'];
$item = R::load('info',$item_id);
$item->id = $_POST['id'];
$item->title = $_POST['title'];
$item->release_year = $_POST['release_year'];
$item->format = $_POST['format'];
$item->stars = $_POST['stars'];
R::store($item);

header( 'Location:/');
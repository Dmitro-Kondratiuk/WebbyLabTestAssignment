<?php
require_once "../config/connect.php";
$item = R::dispense('info');
$item->title = $_POST['title'];
$item->release_year = $_POST['release_yea'];
$item->format = $_POST['format'];
$item->stars = $_POST['stars'];
R::store($item);
header( 'Location:/');
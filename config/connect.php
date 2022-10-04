<?php
require  "../library/rb.php";
R::setup( 'mysql:host=localhost;charset=utf8;dbname=test',
    'root', '');
R::freeze(false);

$pdo = new PDO('mysql:host=127.0.0.1;charset=utf8;dbname=test',
    'root', '');
session_start();
<?php
require  "../library/rb.php";
R::setup( 'mysql:host=127.0.0.1;dbname=test',
    'root', '' );
R::freeze(false);

$connect = mysqli_connect('localhost','root','','test');
session_start();
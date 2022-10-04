<?php
require  "library/rb.php";
R::setup( 'mysql:host=localhost;charset=utf8;dbname=test',
    'root', '' );

session_start();
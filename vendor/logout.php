<?php
require "../config/connect.php";
unset($_SESSION['user']);
header("Location: /");
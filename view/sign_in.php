<?php
require "../config/connect.php";

$data = $_POST;
$errors = [];
if(isset($data['to_login'])){
    $user = R::findOne('users','login = ?',array($data['login']));
    if($user){
        if(password_verify($data['password'],$user['password'])){
            $_SESSION['user']=$user;
            header( 'Location:/');
        }else{
            $errors[]='Password entered incorrectly';
        }
    }else{
        $errors[]="User with this login was not found";
    }
    if(!empty($errors)){
        echo '<p style="color: red">'.array_shift($errors).'</p><hr>';
    }
}

?>
<form action="../view/sign_in.php" method="POST">
    <p>Login</p>
    <input type="text" name="login" value="<?=$_POST['login']?>">
    <p>Password</p>
    <input type="password" name="password" value="<?= $_POST['password']?>">
    <p>
        <button type="submit" name="to_login">Sign in</button>
    </p>
</form>

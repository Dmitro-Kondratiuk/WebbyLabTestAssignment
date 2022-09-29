<?php
require  "../config/connect.php";

$data = $_POST;
$errors = [];

if(isset($data['do_signup'])){

    if(trim($data['login'])==''){
        $errors[] = "You didn't provide a login";
    }
    if(trim($data['email'])==''){
        $errors[] = "You didn't provide a email";
    }
    if($data['password']==''){
        $errors[] = "You didn't provide a password";
    }
    if($data['password_2']!==$data['password']){
        $errors[] = "Repeated password entered incorrectly";
    }
    if(R::count('users',"login=?",array($data['login']))>0){
        $errors[] = "User with this login already exists";
    }
    if(R::count('users',"email=?",array($data['email']))>0){
        $errors[] = "User with this email address already exists";
    }
    if(empty($errors)){
     $user = R::dispense('users');
     $user->login = $data['login'];
     $user->email = $data['email'];
     $user->password = password_hash($data['password'],PASSWORD_DEFAULT) ;
     R::store($user);
     echo '<p style="color: green">You have been successfully registered, go to login <a href="sign_in.php">page</a></p><hr>';
    }else{
        echo '<p style="color: red">'.array_shift($errors).'</p><hr>';
    }
}
?>

<form action="../view/register.php" method="POST">
    <p>Login</p>
    <input type="text" name="login" value="<?= @$data['login']?>">
    <p>Email</p>
    <input type="email" name="email" value="<?= @$data['email']?>">
    <p>Password</p>
    <input type="password" name="password" value="<?= @$data['password']?>">
    <p>Enter the password again</p>
    <input type="password" name="password_2" value="<?= @$data['password_2']?>">
    <p>
        <button type="submit" name="do_signup">Register</button>
    </p>
</form>

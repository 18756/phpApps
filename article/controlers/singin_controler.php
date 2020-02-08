<?php
require_once "connect.php";

if(isset($_COOKIE['id']) ){
	header("Location: index.php");
}

$error = false;

if(isset($_REQUEST['signin']))
{
    $password = $_REQUEST['password'];
    $email = $_REQUEST['email'];
    $sql = "SELECT * FROM `users` WHERE `email`=$email";
    $user = $pdo->query($sql);
    $user = $user->fetch();
    if(password_verify($password, $user['password'])){
        setcookie("signin", "1", time()+10000, '/');
        setcookie("id", $user['id'], time()+10000, '/');
        setcookie("key", $user['secret_key'], time()+10000, '/');
        setcookie("name", $user['nickname'], time()+10000, '/');
        header("Location: index.php");
    }
    else{
    	$error = true;
    }
}

?>
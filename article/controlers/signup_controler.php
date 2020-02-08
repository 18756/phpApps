<?php
require_once "connect.php";

if(isset($_COOKIE['id']))
{
	header("Location: index.php");
}


$errors = [];

if(isset($_REQUEST['signup']))
{
    $nickname = $_REQUEST['nickname'];
    var_dump($nickname);
    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];
    $confirm_password = $_REQUEST['confirm_password'];
    
    if(!($nickname && $email && $password && $confirm_password))
    {
    	$errors[] = "Fill in all the fiels";
    }

    if(strlen($nickname) > 100)
    {
        $errors[] = "Too long nickname";
    }

    if(!preg_match('/.+@.+[.].+/', $email))
    {
        $errors[] = "Wrong email";
    }

    if($password !== $confirm_password)
    {
    	$errors[] = "Confirm password is not like password";
    }

    if(strlen($password) > 100)
    {
    	$errors[] = "Too long password";
    }

    if(empty($errors))
    {
        $sql = "SELECT EXISTS(SELECT `id` FROM `users` WHERE `nickname`=$nickname)";
        $res = $pdo->query($sql);
        if($res->fetch()[0] == 1)
        {
            $errors[] = "This nickname is busy";
        }

        $sql = "SELECT EXISTS(SELECT `id` FROM `users` WHERE `email`=$email)";
        $res = $pdo->query($sql);
        if($res->fetch()[0] == 1)
        {
            $errors[] = "This email is busy";
        }

        if(empty($errors))
        {
    	    $password = password_hash($password, PASSWORD_DEFAULT);
    	    $secret_key = md5($nickname.rand(0, 10).time());
    	    $sql = "INSERT INTO `users` (`nickname`, `email`, `password`, `secret_key`) VALUES ($nickname, $email, '$password', '$secret_key')";
            
    	    $pdo->query($sql);
    	    setcookie("signin", "1", time()+10000, '/');

    	    $sql = "SELECT `id` FROM `users` WHERE `nickname`=$nickname";
    	    $id = $pdo->query($sql);
            $id = $id->fetch()[0];
    	    setcookie("id", $id, time()+10000, '/');
            setcookie("key", $secret_key, time()+10000, '/'); 
            setcookie("name", $nickname, time()+10000, '/');           
            header("Location: index.php");
                    
        }
    }
}
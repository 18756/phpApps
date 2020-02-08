<?php
require_once "connect.php";
function my_filter($str){
    global $pdo;
    $str = trim($str);
    $str = strip_tags($str);
    $str = htmlspecialchars($str);
    $str = $pdo->quote($str);
    return $str;
}

foreach ($_REQUEST as $key => $value) {
    $_REQUEST[$key] = my_filter($value);	
}

foreach ($_POST as $key => $value) {
    $_POST[$key] = my_filter($value);	
}

foreach ($_GET as $key => $value) {
    $_GET[$key] = my_filter($value);	
}

foreach ($_COOKIE as $key => $value) {
	if($key == "key" || $key == "id")
	{
    	$_COOKIE[$key] = my_filter($value);
    }	
}



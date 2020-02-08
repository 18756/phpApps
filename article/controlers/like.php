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

if(isset($_COOKIE['id']) && isset($_COOKIE['key']))
{

	$name = str_replace("'", "", $_COOKIE['name']);
	$id = $_COOKIE['id'];
	$key = $_COOKIE['key'];
	$sql = "SELECT count(*) FROM `users` where `id`=$id AND `secret_key`=".my_filter($key);
	$checking = $pdo->query($sql);
	$checking = $checking->fetch();
    $active_user = boolval($checking[0]); 
}
else{
	$active_user = false;
}

if(!$active_user){
	exit();
}

$json = [];

$id_answer = $_POST['id'];
$id_user = $_COOKIE['id'];


$sql = "SELECT `likes`, `dislikes` FROM `users` WHERE `id`=".my_filter($id_user);
$res = $pdo->query($sql);
$res = $res->fetch();
$likes = explode(" ", $res['likes']);
$dislikes = explode(" ", $res['dislikes']);

if(in_array($id_answer, $likes)){
	$key = array_search($id_answer, $likes);
	unset($likes[$key]);

	$sql = "UPDATE `answers` SET `likes`=`likes`-1 WHERE `id`=".my_filter($id_answer);
	$pdo->query($sql);

	$json[] = "unlike";
	
}
else{
	$likes[] = $id_answer;
	$sql = "UPDATE `answers` SET `likes`=`likes`+1 WHERE `id`=".my_filter($id_answer);
	$pdo->query($sql);

	$json[] = "like";

	if(in_array($id_answer, $dislikes)){
		$json[] = "undislike";
		$key = array_search($id_answer, $dislikes);
		unset($dislikes[$key]);
		$sql = "UPDATE `answers` SET `dislikes`=`dislikes`-1 WHERE `id`=".my_filter($id_answer);
		$pdo->query($sql);
	}
}


$likes = implode(" ", $likes);
$dislikes = implode(" ", $dislikes);

$sql = "UPDATE `users` SET `likes`='$likes', `dislikes`='$dislikes' WHERE `id`=".my_filter($id_user);


$pdo->query($sql);


echo json_encode($json);
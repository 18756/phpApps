<?php
require_once "controlers/connect.php";
$question = $_GET['id'];
$sql = "SELECT * FROM `answers` WHERE `question`=$question ORDER BY `likes`-`dislikes` desc";
$data = $pdo->query($sql)->fetchAll();

if($active_user){


$id_user = $_COOKIE['id'];
$sql = "SELECT `likes`, `dislikes` FROM `users` WHERE `id`=$id_user";
$res = $pdo->query($sql);
$res = $res->fetch();
$likes = explode(" ", $res['likes']);
$dislikes = explode(" ", $res['dislikes']);
}
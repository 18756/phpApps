<?php
require_once "controlers/connect.php";
$sql = "SELECT * FROM `questions` ORDER BY `views` DESC";
$data = $pdo->query($sql)->fetchAll();
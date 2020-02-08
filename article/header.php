<?php
require_once "controlers/filter.php";
require_once "controlers/active_user.php";


if(!$active_user){
?>
<a href="signin.php">Sign in</a>
<?php }
else {?>
<a href="controlers/logout.php">Log out</a><br>
Приветствую тебя, <?=$name;?>
<?php }?>
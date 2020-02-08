<?php
setcookie("id", "", time()-1, '/');
setcookie("key", "", time()-1, '/');
header("Location: ../index.php");
?>
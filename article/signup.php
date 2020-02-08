<?php 
require_once "controlers/filter.php";
require_once "controlers/signup_controler.php";
foreach ($errors as $error) {?>
	<div class="error"><?=$error;?></div>
<?php }?>
<br>
<a href="signin.php">Sing in</a><br>
<form method="post">
	Nickname: <input type="text" name="nickname" value="<?=@$_POST['nickname']?>"><br>
	Email: <input type="text" name="email" value="<?=@$_POST['email']?>"><br>
	Password: <input type="password" name="password"><br>
	Confirm password: <input type="password" name="confirm_password"><br>
	<button name="signup">Sign up</button>
</form>

<style type="text/css">
	.error {
		color: red;
	}
</style>
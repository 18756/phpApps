<?php 
require_once "controlers/filter.php";
require_once "controlers/singin_controler.php";

if($error){?>

	<div class="errors">Wrong email or password</div>

<?php }?>

<a href="signup.php">Sign up</a><br>
<form method="post">
	Email: <input type="text" name="email" value="<?=@$_POST['email']?>"><br>
	Password: <input type="password" name="password"><br>
	<button name="signin">Sign in</button>
</form>


<style type="text/css">
	.errors {
		color: red;
	}
</style>
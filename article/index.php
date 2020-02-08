<?php
require_once "controlers/no_cache.php";
require_once "header.php";

if(isset($_COOKIE['signin'])){?>

    <h3>Вы успешно вошли</h3>

<?php 
setcookie("signin", "1", time()-1, '/');
}
if($active_user){
	require_once "controlers/add_questions.php";
?>
<br><br>
<form method="post">
	<label>Your question: <input type="text" name="question"></label><br>
	<button name="add_question">Ask question</button>
</form>
<?php }?>

<h1>Вопросы: </h1>

<?php require_once "controlers/get_questions.php";
foreach($data as $q){?>
	<div>
		<a href="question.php?id=<?=$q['id']?>"><?=$q['date']?> <?=$q['author']?>) <?=$q['question']?> (Answers: <?=$q['answers']?>)  (Views: <?=$q['views']?>)</a>
	</div>
<?php } ?>
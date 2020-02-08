<a href="/article">Main page</a><br>

<?php require_once "header.php";
require_once "controlers/current_question.php";?>



<h1>Вопрос: <?=$data['date']?> <?=$data['author']?>) <?=$data['question']?></h1>


<?php if($active_user){ 
require_once "controlers/add_answers.php";?>

<form method="post">
	<label>Your answer: <input type="text" name="answer"></label>
	<button name="add_answer">Add answer</button>
</form>

<?php }?>

<h2>Ответы: </h2>

<?php require_once "controlers/get_answers.php";
foreach($data as $a){?>


<div><?=$a['date']?> <?=$a['author']?>) <?=$a['answer']?> <span id="like<?=$a['id']?>" class="like <?php if(@in_array($a['id'], $likes)){echo "red";}?>">likes  (<span id='l<?=$a['id']?>'><?=$a['likes']?></span>)</span>

   <span id="dislike<?=$a['id']?>" class="dislike <?php if(@in_array($a['id'], $dislikes)){echo "red";}?>">dislikes  (<span id='d<?=$a['id']?>'><?=$a['dislikes']?></span>)</span>
   </div>


<?php }
if($active_user){?>


<script type="text/javascript" src='j.js'></script>
<script type="text/javascript">


	$('.like').click(function(e){
		var id = e['target']['id'].replace(/[^0-9]/gim,'');
		$.ajax({
			url: "controlers/like.php",
			type: "POST",
			data: ({id: id}),
			success: function(data)
			{
				data = JSON.parse(data);
				var likes = parseInt($("#l"+id).html());

				if(data.indexOf("unlike") != -1)
				{		
                    $("#l"+id).html(likes-1);
                    $("#like"+id).removeClass("red");
				}

				if(data.indexOf("like") != -1)
				{
					$("#l"+id).html(likes+1);
                    $("#like"+id).addClass("red");
				}
                
                if(data.indexOf("undislike") != -1)
                {
                	var dislikes = parseInt($("#d"+id).html());
                	$("#d"+id).html(dislikes-1);
                    $("#dislike"+id).removeClass("red");
                }

			}
			
		});
       
	})

	$('.dislike').click(function(e){
		var id = e['target']['id'].replace(/[^0-9]/gim,'');
		$.ajax({
			url: "controlers/dislike.php",
			type: "POST",
			data: ({id: id}),
			success: function(data)
			{
				data = JSON.parse(data);
				console.log(data);
				var dislikes = parseInt($("#d"+id).html());

				if(data.indexOf("undislike") != -1)
				{		
                    $("#d"+id).html(dislikes-1);
                    $("#dislike"+id).removeClass("red");
				}

				if(data.indexOf("dislike") != -1)
				{
					$("#d"+id).html(dislikes+1);
                    $("#dislike"+id).addClass("red");
				}
                
                if(data.indexOf("unlike") != -1)
                {
                	var likes = parseInt($("#l"+id).html());
                	$("#l"+id).html(likes-1);
                    $("#like"+id).removeClass("red");
                }

			}
		});

	})
</script>


<?php }?>


<style type="text/css">
	.red{
		color: red;
	}
</style>
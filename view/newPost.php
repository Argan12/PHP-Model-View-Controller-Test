<?php
	if ($_SESSION['id'] == NULL)
	{
		session_destroy();
		header('Location:index.php');
	}
?>

<!DOCTYPE HTML>

<html>

<head>
	<meta charset="utf-8"/>
	<link rel="stylesheet" href="public/css/style.css"/>
	<title>Nouveau billet</title>
</head>

<body>
	<h2>&Eacute;crire un nouveau billet</h2>
	
	<p><a href="index.php?action=listPosts" class="back">Retour à la page principale</a></p>
	
	<div class="container">
		<div class="title">
			<p>Title</p>
		</div>
		
		<div class="content">
			<form action="index.php?action=savePost" method="post" name="newPost">
				<label for="title">Titre :</label>
				<input type="text" id="newpost" name="title"/><br/>
				<label for="content">Contenu :</label>
				<textarea name="content"></textarea><br/>
				
				<input type="submit" id="post_submit" onclick="getMessage()" value="Publier"/>
			</form>
		</div>
	</div>
	
	<script type="text/javascript">
		function getMessage() {
			var title = document.newPost.title.value;
			var content = document.newPost.content.value;
			
			if ((title == "") && (content == ""))
				alert("Veuillez renseigner les champs ci-dessous !");
			else if ((title == "") && (content != ""))
				alert("Veuillez renseigner un titre à votre post !");
			else if ((title != "") && (content == ""))
				alert("Veuillez renseigner un contenu à votre post !");
		}
	</script>
</body>

</html>
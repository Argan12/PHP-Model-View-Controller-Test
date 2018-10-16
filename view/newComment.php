<?php
	// If user is not log in, this page's access is blocked
	// Redirection to index.php
	if ($_SESSION['id'] == NULL)
	{
		session_destroy();
		header('Location:index.php');
	}
?>

<!-- Post comment page -->
<!DOCTYPE HTML>

<html lang="fr">
	<head>
		<meta charset="utf-8"/>
		<link rel="stylesheet" href="public/css/style.css"/>
		<title>Commenter</title>
	</head>
	
	<body>
		<!-- Navigation bar -->
		<div id="navbar_container">
			<div id="navbar">
				<p>Bonjour, <?= $_SESSION['firstname'];?></p>
				<div class="logout"><a href="index.php?action=logout" class="log">Se déconnecter</a></div>
			</div>
		</div>

		<h2>Publier un commentaire</h2>
	
		<p><a href="index.php?action=listPosts" class="back">Retour à la page principale</a></p>
		
		<!-- Display post to comment -->
		<div class="container">
			<div class="title">
				<p><?= $post['title'];?></p>
			</div>
	
			<div class="content">
				<p><?= $post['content'];?></p>
			</div>

			<?php $countComments = $count->fetch(); ?>
			
			<div class="comments">
				<a href="index.php?action=comment&id=<?= $post['post_id'] ?>" class="comment"><?php echo $countComments['nb_comments']; 
					if ($countComments['nb_comments'] <= 1)
						echo ' commentaire';
					else if ($countComments['nb_comments'] > 1)
						echo ' commentaires';
					?>
				</a>
				<a href="index.php?action=new_comment&id=<?= $post['post_id'] ?>" class="comment">Commenter</a>
				<a href="index.php?action=updatePost&id=<?= $post['post_id']; ?>" class="comment">Modifier</a>
				<a href="index.php?action=deletePost&id=<?= $post['post_id']; ?>" class="comment">Supprimer</a>
			</div>
		</div>
	
		<!-- Post comment via form below -->
		<div class="container">
			<div class="title">
				<p>Nouveau commentaire</p>
			</div>
		
			<div class="content">
				<form action="index.php?action=saveComment&id=<?php echo $_GET['id']; ?>" method="post" name="new_comment">
					<label for="content">Contenu :</label>
					<textarea name="comment"></textarea><br/>
				
					<input type="submit" id="post_submit" onclick="getMessage()" value="Publier"/>
				</form>
			</div>
		</div>
	</body>
	
	<!-- Display an alert if inputs are empty -->
	<script type="text/javascript">
		function getMessage() {
			var content = document.new_comment.comment.value;
			
			if (content == "")
				alert("Veuillez entrer un commentaire !");
		}
	</script>
</html>

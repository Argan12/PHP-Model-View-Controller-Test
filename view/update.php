<?php
	// If user is not log in, this page's access is blocked
	// Redirection to index.php
	if ($_SESSION['id'] == NULL)
	{
		session_destroy();
		header('Location:index.php');
	}
?>

<!-- Modify a post -->
<!DOCTYPE HTML>

<html lang="fr">

<head>
	<meta charset="utf-8"/>
	<link rel="stylesheet" href="public/css/style.css"/>
	<title>Modifier l'article <?= $post['title']; ?></title>
</head>

<body>
	<h2>Modifier l'article &laquo; <?= $post['title']; ?> &raquo;</h2>
	
	<p><a href="index.php?action=listPosts" class="back">Retour à la page principale</a></p>
	
	<!-- Display post to modify -->
	<div class="container">
		<div class="title">
			<p><?= $post['title'];?></p>
		</div>
	
		<div class="content">
			<p><?= $post['content'];?></p>
		</div>
			
		<div class="comments">
			<a href="index.php?action=comment&id=<?= $post['post_id'] ?>" class="comment">Commentaires</a>
			<a href="index.php?action=new_comment&id=<?= $post['post_id'] ?>" class="comment">Commenter</a>
			<a href="index.php?action=updatePost&id=<?= $post['post_id']; ?>" class="comment">Modifier</a>
			<a href="index.php?action=deletePost&id=<?= $post['post_id']; ?>" class="comment">Supprimer</a>
		</div>
	</div>
	
	<!-- Enter the new post content via form below -->
	<div class="container">
		<div class="title">
			<p>Modifier un article</p>
		</div>
		
		<div class="content">
			<form action="index.php?action=updatePost&id=<?= $post['post_id']; ?>" method="post" name="newPost">
				<label for="title">Titre :</label>
				<input type="text" id="newpost" name="title"/><br/>
				<label for="content">Contenu :</label>
				<textarea name="content"></textarea><br/>
				
				<input type="submit" id="post_submit" value="Publier"/>
			</form>
		</div>
	</div>
</body>

</html>

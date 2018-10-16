<?php
	// If user is not log in, this page's access is blocked
	// Redirection to index.php
	if ($_SESSION['id'] == NULL)
	{
		session_destroy();
		header('Location:index.php');
	}
?>

<!DOCTYPE HTML>

<html lang="fr">

<head>
	<meta charset="utf-8"/>
	<link rel="stylesheet" href="public/css/style.css"/>
	<title>Mon site Web</title>
</head>

<body>
	<!-- Navigation bar -->
	<div id="navbar_container">
		<div id="navbar">
			<p>Bonjour, <?= $_SESSION['firstname'];?></p>
			<div class="logout"><a href="index.php?action=logout" class="log">Se déconnecter</a></div>
		</div>
	</div>
	
	<h2>Bienvenue sur mon site Web !</h2>
	
	<h3>Derniers billets :</h3>
	
	<p><a href="index.php?action=newPost" class="new">&Eacute;crire un nouveau billet</a></p>
	
	<?php
		// Display every posts saved in database
		while ($posts = $searchPosts->fetch())
		{
			?>
			<div class="container">
				<div class="title">
					<p><?= $posts['title'];?></p>
				</div>
		
				<div class="content">
					<p><?= $posts['content'];?></p>
				</div>
				
				<div class="comments">
					<a href="index.php?action=comment&id=<?= $posts['post_id']; ?>" class="comment">Commentaires</a>
					<a href="index.php?action=new_comment&id=<?= $posts['post_id']; ?>" class="comment">Commenter</a>
					<a href="index.php?action=update&id=<?= $posts['post_id']; ?>" class="comment">Modifier</a>
					<a href="index.php?action=deletePost&id=<?= $posts['post_id']; ?>" class="comment">Supprimer</a>
				</div>
			</div>
			<?php
		}
		
		$searchPosts->closeCursor();
	?>
	
</body>

</html>

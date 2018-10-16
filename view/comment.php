<?php
	// If user is not log in, this page's access is blocked
	// Redirection to index.php
	if ($_SESSION['id'] == NULL)
	{
		session_destroy();
		header('Location:index.php');
	}
?>

<!-- Display comments page -->
<!DOCTYPE HTML>

<html>
	<head>
		<meta charset="utf-8"/>
		<link rel="stylesheet" href="public/css/style.css"/>
		<title>Commentaires</title>
	</head>
	
	<body>
		<!-- Navigation bar -->
		<div id="navbar_container">
			<div id="navbar">
				<p>Bonjour, <?= $_SESSION['firstname'];?></p>
				<div class="logout"><a href="index.php?action=logout" class="log">Se déconnecter</a></div>
			</div>
		</div>

		<h2>Commenter l'article : <?= $post['title']; ?></h2>
		
		<p><a href="index.php?action=listPosts" class="back">Retour à la page principale</a></p>
		
		<!-- Get post by id -->
		<div class="container">
			<div class="title">
				<p><?= $post['title']; ?></p>
			</div>
	
			<div class="content">
				<p><?= $post['content']; ?></p>
				<p style="font-size:12px"><?= $post['datetime']; ?></p>
			</div>
		</div>
		
		<!-- Display comments which correspond to the post -->
		<?php			
			while ($comment = $comments->fetch())
			{
				?>
				<div class="comments_box">
					<div class="author">
						<p>
							<?= $comment['author_firstname'].' '.$comment['author_lastname']; ?><br/>
							<span style="font-weight:normal;font-size:12px"><?= $comment['fr_date']; ?></span>
						</p>
					</div>
			
					<div class="comment_content">
						<?= $comment['comment']; ?>
					</div>
				</div>
				<?php
			}
		?>
	</body>
</html>		

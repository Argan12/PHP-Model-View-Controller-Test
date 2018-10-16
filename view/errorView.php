<!-- This page appears if there is an error in URL -->

<!DOCTYPE HTML>

<html lang="fr">

<head>
	<meta charset="utf-8"/>
	<link rel="stylesheet" href="public/css/style.css"/>
	<title><?= $errorMessage ?></title>
</head>

<body>
	<h2><?= $errorMessage ?></h2>
	
	<p><strong>Cette page n'existe pas..</strong></p>
	<p>Le lien a peut-être été rompu, une erreur est peut-être contenue dans l'URL ou bien la page a probablement été supprimée.</p>
	
	<div id="thumb_down">
		<img src="public/img/thumbs-down-symbole_318-40864.jpg" width="250px" height="250px"/>
	</div>
	
	<div id="actions">
		<p><a class="error" href="#" onclick="javascript:history.back()">Revenir à la page précédente</a></p>
		<p><a class="error" href="index.php?action=listPosts">Revenir à la page principale</a></p>
		<p><a class="error" href="index.php?action=logout">Se déconnecter</a></p>
	</div>
</body>

</html>

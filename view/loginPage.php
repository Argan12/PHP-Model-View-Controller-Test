<!DOCTYPE HTML>

<html>

<head>
	<meta charset="utf-8"/>
	<link rel="stylesheet" href="public/css/style.css"/>
	<title>Bienvenue sur mon blog !</title>
</head>

<body>
	<h2>Bienvenue sur mon site Web !</h2>
	
	<div id="login">
		<h3>S'authentifier</h3>
		
		<form method="post" action="index.php?action=login">
			<input type="text" id="login_input" name="mail_address" placeholder="Adresse e-mail"/>
			<input type="password" id="login_input" name="password" placeholder="Mot de passe"/>
			<input type="submit" id="login_submit" value="Valider"/>
		</form>
	</div>
		
	<div class="container">	
		<div class="title">
			<p>S'inscrire</p>
		</div>
		
		<div class="content">
			<form method="post" action="index.php?action=registerPage" name="registerForm">
				<label for="lastname">Nom :</label>
				<input type="text" id="register" name="lastname"/><br/>
				<label for="firstname" id="register" name="firstname">Prénom :</label>
				<input type="text" id="register" name="firstname"/><br/>
				<label for="mail_address">Adresse e-mail :</label>
				<input type="text" id="register" name="mail_address"/><br/>
				<label for="password">Mot de passe :</label>
				<input type="password" id="register" name="password"/><br/>
				
				<input type="submit" id="register_submit" onclick="verifyInputs()" value="Valider"/>
			</form>
		</div>
	</div>
	
	<script type="text/javascript">
		function verifyInputs() {
			var fname = document.registerForm.firstname.value;
			var lname = document.registerForm.lastname.value;
			var mail = document.registerForm.mail_address.value;
			var pass = document.registerForm.password.value;
	
			if ((lname != "") && (fname != "") && (mail != "") && (pass != ""))
			{
				if ((/^[\w.-]+@[\w.-]+\.[a-z]{2,6}$/.test(mail)) && (/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W)/.test(pass)))
				{
					if (pass.length >= 8)
						alert("Votre compte a été crée. Vous pouvez désormais vous connecter");
					else 
						alert("Le mot de passe doit contenir au moins 8 caractères !");
				} else {
					alert("Adresse e-mail ou mot de passe incorrect");
				}
			} else {
				alert("Veuillez remplir tous les champs !");
			}
		}
	</script>
</body>

</html>
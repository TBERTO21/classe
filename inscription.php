<html>

	<head>
		<meta charset="utf-8">
		<title>inscription</title>

		<link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/flaticon.css">
    <link rel="stylesheet" href="assets/css/style.css">
	</head>
	<body class=body2>
		<header>
		<nav>
		<?php 
		include('header.php');
	if(isset($_SESSION['login']))
		{
				header('Location: index.php');
        } 
		require "class/utilisateur.php";
	$var = new connexion_inscription; ?>
</ul>
 </nav>
        </header>
        

		
		<main>
			<section><form action="inscription.php" class="forme" method="post">
			<fieldset class=inscrip>
				<legend>Créez un compte</legend>
				<label for="pseudo">Pseudo :</label>
					<input type="text" name="login" maxlength="8"  required placeholder="login"/>
				<label for="email">Email :</label>
					<input type="email" name="email"  size="30"  placeholder="toto@exemple.com"/>
				<label for="password">Mot de Passe :</label>
					<input type="password" name="pass" minlength="4" required placeholder="password"/>
				<label for="password">Confirmation mot de Passe :</label>
					<input type="password" minlength="4"  name="pass2" required placeholder="confirmation"/>					
			</fieldset>

				<label><input type="checkbox" name="condition" required placeholder="condition"/> <a href="">J'accepte les conditions générales d'utilisation.</a></label>
					<input type="submit" value="inscription" name="inscription"/>
				</form>
			</section>							
			
					<?php
					
				
					$var->inscription();
				?>
            



            <section>
				</main>
		
<footer>
    <div class="footer">
		<div id="mentions">
			<div>
				<a href="mentions.html">Mentions légales</a>
				<a href="contact.php">Contactez-nous</a>
			</div>
				<p>© 2020 Tous droits réservés T&I COMPANY</p>
		</div>
	</div>
	
</footer>
				
			</body> 
</html>
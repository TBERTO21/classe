<html>

	<head>
		<meta charset="utf-8">
		<title>profil</title>
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/flaticon.css">
    <link rel="stylesheet" href="assets/css/style.css">
	</head>
	<body>
		<header class="topnav">
			<nav id="menu">
				<ul> <?php include('header.php') ;
					if(!isset($_SESSION['login']))
					{header('Location: connexion.php');}                 
                    require "class/profil.php"; 
                    $profile = new profile();




					?></ul>				
		</header>
		<main>
			    <h1>Modification profil</h1>
            <section>
                <form class="forme" action="" method="post">
                    <fieldset>
                        <legend>Identifiants</legend>
                        <label>Login :
                            <input type="text"   value="<?php echo $_SESSION['login']  ?>" name="login" maxlength="8"  required placeholder="login"/></label>
						
						<label>Mot de passe :
                            <input type="password" name="passe" minlength="4"  placeholder=" new password"/></label>
                        <label>Confirmation :
                            <input type="password" minlength="4"  name="passe2"  placeholder="confirmation"/></label>
                    </fieldset>
				     	<label>
                            <input type="checkbox" name="condition" required placeholder="condition"/> <a href="">J accepte les conditions générales d utilisation.*</a>
                        </label>
                            <input type="submit" value="modif" name="modifier"/>
                </form>
            </section>
			<?php
			if (!empty($_POST['modifier'])) {
    $login = $_SESSION['login'];                
    $newlogin = $_POST["login"];
    $newPassword = $_POST["passe"];
    $newPassword2 = $_POST["passe2"];

    if ($newPassword != $newPassword2) {
        echo "<p class='bug'>Mots de passe différents</p>";
    } else {
        if ($profile->modif_profil($login, $newlogin, $newPassword, $connexion)) {
            echo '<p class="bug">Modifié avec succès</p>';
        } else {
            echo '<p class="bug">Erreur lors de la mise à jour</p>';
        }
    }
}
            
                        ?>
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

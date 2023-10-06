<?php
    class profile 
    {
        private $host = "localhost";
		private $username = "root";
		private $password = "";
        private $db = "classe";
		
		
		public function donnees_profil()
		{
			$connexion = mysqli_connect($this->host, $this->username, $this->password, $this->db);
			$sql = "SELECT * FROM utilisateurs WHERE login = '".$_SESSION['login']."'";
			$query = mysqli_query($connexion, $sql);
			return $query;
		}
	
		$newPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Requête SQL pour mettre à jour le mot de passe
        $updateQuery = "UPDATE utilisateurs SET login = '$newLogin', password = '$newPassword' WHERE login = '$login'";

        if (mysqli_query($connexion, $updateQuery)) {
            // Mise à jour réussie, utilisez la nouvelle méthode pour mettre à jour la session
            $_SESSION['login'] = $newLogin;
            return true; // Mise à jour réussie
        } else {
            echo "Erreur lors de la mise à jour : " . mysqli_error($connexion);
            return false; // Erreur lors de la mise à jour
        }

		public function modif_profil($login, $newLogin, $newPassword, $connexion)
    {
        // Hash du nouveau mot de passe
        $newPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Requête SQL pour mettre à jour le mot de passe
        $updateQuery = "UPDATE utilisateurs SET login = '$newLogin', password = '$newPassword' WHERE login = '$login'";
        echo $updateQuery;

        if (mysqli_query($connexion, $updateQuery)) {
            // Mise à jour réussie, utilisez la nouvelle méthode pour mettre à jour la session
            $_SESSION['login'] = $newLogin;
            return true; // Mise à jour réussie
        } else {
            echo "Erreur lors de la mise à jour : " . mysqli_error($connexion);
            return false; // Erreur lors de la mise à jour
        }
    }
}
    
	}
?>



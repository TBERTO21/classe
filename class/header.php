 <?php
    class header 
    {
        private $host = "localhost";
		private $username = "root";
		private $password = "";
        private $db = "classe";
		
    
    public function getGrade($connexion, $login)

        {           
            $requete = "SELECT grade FROM utilisateurs WHERE login = '$login'";
            $resultat = mysqli_query($connexion, $requete);
            $grade = mysqli_fetch_array($resultat);
             return $grade['grade'];
        }
      
    public function getId($connexion, $login)
    {
        $requete = "SELECT id FROM utilisateurs WHERE login = '$login'";
        $resultat = mysqli_query($connexion, $requete);
        $utilisateur = mysqli_fetch_assoc($resultat);

        if ($utilisateur) {
            return $utilisateur['id'];
        } else {
            return null; // Retourne null si l'utilisateur n'est pas trouvé
        }
    }



    public function Categories()
        {
            $connexion = mysqli_connect($this->host, $this->username, $this->password, $this->db);
            $requete = "SELECT * FROM categories ORDER BY nom";
            $resultat = mysqli_query($connexion, $requete);
    
            if ($resultat && mysqli_num_rows($resultat) > 0) 
            {
                while ($categorie = mysqli_fetch_assoc($resultat)) 
                {
                    echo '<li><a href="produit.php?ctg=' . $categorie['id'] . '">' . $categorie['nom'] . '</a></li>';
                }
            }
        } 


        
    public function deconnexion($connexion, $idut)
    {    if (isset($_SESSION['login'])) 
        {session_unset();
        session_destroy();}
        header('Location: index.php');

        $delete = "DELETE FROM panier WHERE id_utilisateurs='$idut'";
        $quer = mysqli_query($connexion, $delete);
    }

    public function getPanier($connexion, $idut)
    {
        $quan = "SELECT SUM(quantite) as quant FROM panier WHERE id_utilisateurs='$idut'";
        $tit = mysqli_query($connexion, $quan);
        $ite = mysqli_fetch_array($tit);

        if ($ite && isset($ite['quant'])) {
            return $ite['quant'];
        } else {
            return 0; 
        }
    }


    }
?>     

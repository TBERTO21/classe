            <?php
         
         class connexion_inscription
         {
           private $host = "localhost";
           private $username = "root";
           private $password = "";
           private $db = "classe";
           
           public function inscription()
           {
             if(isset($_POST['inscription']))
             {
               if(!empty($_POST['login']) && !empty($_POST['pass']) && !empty($_POST['pass2']) && !empty($_POST['email']))
               {
                 $login = $_POST['login'];
                 $pass = $_POST['pass'];
                 $pass2 = $_POST['pass2'];
                           $email = $_POST['email'];
                           
                 $connexion = mysqli_connect($this->host, $this->username, $this->password, $this->db);
                 
                 if($pass == $pass2)
                 {
                   if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#i", $email))
                   {
                     $nouveau_mail = "SELECT id FROM utilisateurs WHERE email='".$email."'";
                     $resultat = mysqli_query($connexion, $nouveau_mail);
                     $nombre_mail = mysqli_num_rows($resultat);
       
                     if($nombre_mail == 0)
                     {
                       if (preg_match('#^[a-z0-9_]+#', $login))
                       {
                         $nouveau_login = "SELECT id FROM utilisateurs WHERE login='".$login."'";
                         $resultat = mysqli_query($connexion, $nouveau_login);
                         $nombre_login = mysqli_num_rows($resultat);
       
                         if($nombre_login == 0)
                         {
                           $passe = password_hash($pass, PASSWORD_DEFAULT);
                           $sql= "INSERT INTO utilisateurs (login, password, email, grade) VALUES ('$login', '$passe', '$email', 1)";
                           mysqli_query($connexion, $sql);
                           mysqli_close($connexion);
                           header('Location: connexion.php');
                                           }
                         else
                         {
                           echo "Le pseudo $login est déjà utilisé";
                         }
                       }
                       else
                       {
                         echo "Votre pseudo n'est pas valide";
                       }
                     }
                     else
                     {
                       echo "L'adresse email $email est déjà utilisé";
                     }
                   }
                   else
                   {
                     echo "L'adresse email $email n'est pas valide";
                   }
                 }
                 else
                 {
                   echo "Les deux mots de passe que <br /> vous avez rentrés ne correspondent pas";
                 }
               }
               else
               {
                 echo "Veuillez remplir toutes les casses";
               }
             }
       
             if(isset($_POST["connexion"]))
             {
               header("location:connexion.php");
             }
               }
               
              
               public function connexion()
        {
          if (isset($_POST['Connexion'])) 
          {
              if (!empty($_POST['login']) && !empty($_POST['pass'])) 
              
                  {
                        $connexion = mysqli_connect($this->host, $this->username, $this->password, $this->db);
                        $sql = "SELECT * FROM utilisateurs WHERE login='".$_POST['login']."'";
                        $req = mysqli_query($connexion, $sql);
                        $data = mysqli_fetch_assoc($req);
                        
                        if(password_verify($_POST['pass'], $data['password']))
                        {
                            $_SESSION['login'] = $_POST['login'];
                            $_SESSION['password'] = $_POST['pass'];
                            $_SESSION['id'] = $data['grade'];
                           
                            header('Location: index.php');
                        }
                        else 
                        {
                            echo "Mauvais login / mot de passe. Merci de recommencer <br />";
                        }
                        mysqli_close($connexion);
                    }
                    else 
                    {
                        echo "Remplissez tous les champs pour vous connectez !";
                    }
                }
			
				if(isset($_POST["inscription"])) 
				{
					header("location:inscription.php");
				}
            }
               
               
               }?>
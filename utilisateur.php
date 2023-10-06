<html>

	<head>
		<meta charset="utf-8">
		<title>admin</title>
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/flaticon.css">
    <link rel="stylesheet" href="assets/css/style.css">
	</head>
	<body>
    <header class="topnav">
			<nav id="menu">
                <ul> <?php include('header.php') ;
                if (isset($_SESSION['login']))
                {
                    $login=$_SESSION['login'];
                    $connexion = mysqli_connect("localhost", "root", "", "boutique");
                    $sql = "SELECT * FROM utilisateurs WHERE login = '$login'";
                    $req = mysqli_query($connexion,$sql);
                    $data = mysqli_fetch_array($req);
                    if($data['grade'] == 21 OR $data['grade'] == 28 )
                    {

                    }
                    else{
                        header('Location: index.php');
                    }
                }
                else
                {
                    header('Location: index.php');
                }
                ?></ul>				

		</header>
        <section>
                <form  class="forme"method="post">
                    <fieldset>
                        <legend>Nouvelle catégorie</legend>
                        <input  required type="text" name="titre" size="50" placeholder="titre"/> 
                        <input type="submit" name="creer" value="Poster"/>

                    </fieldset>
	            </form>
            <?php
            if(isset($_POST["creer"]))
            {
                $titre=$_POST["titre"];
                $connexion = mysqli_connect("localhost", "root", "", "boutique");
	            $requete = "INSERT INTO `categories` (`id`,`nom`) VALUES (NULL,'".$titre."')";  
                $query = mysqli_query($connexion, $requete);

            }	
            ?>
        </section>


        <section>
                <form class="forme" method="post" action="">
                    <fieldset>
                        <legend>Supprimer une categorie</legend>                 
                            <input type="text" name="ctg"/>
                            <input type="submit" name="sup" value="supprimer"/>
                    </fieldset>
                </form>
                        <?php
                        if(isset($_POST['sup']))
                    {
						$base = mysqli_connect("localhost", "root", "", "boutique");
						$ctg=$_POST['ctg'];
						$delete="DELETE FROM `categories` WHERE nom='$ctg'";
						$quer= mysqli_query($base,$delete);
						echo "<p class='bug'>$ctg supprimée avec succès !</p>";
					}
                        ?>
					    

        <section>
                    <div>
	                    <form  class="forme"method="post">
                            <fieldset>
                            <legend>Nouveau produit</legend>
                                <input type="text"  name="nom" placeholder="nom"  />
                                <input type="text"  name="artiste" placeholder="artiste" />
                                <input type="text"  name="type" placeholder="type"  />
			                    <textarea  required type="text" name="des" size="50" placeholder="description"></textarea>
                                <input type="texte" name="image"  placeholder="lien dossier image"/>
                                <input type="texte" name="prix"  placeholder="prix"/>
                                <select name="ctg">
                                    <legend>Catégories ?</legend>
                               
                                    <?php
                                    $categories = "SELECT * FROM categories ";
                                    $quer = mysqli_query($connexion,$categories);
                                    while ($data = mysqli_fetch_array($quer))
                                    {
                                        echo'<option>'.$data['nom'].'</option>';
                                    }
                                    ?>
                                </select>


			                    <input type="submit" name="goo" value="Poster"/>
	                        </fieldset>
                        </form>
                        
                        <?php
                        
                        if(isset($_POST["goo"]))
                        
                        {  $ctg=$_POST['ctg'];

                            $ctg = "SELECT * FROM categories WHERE nom = '$ctg'"; 
                            $ctg2 = mysqli_query($connexion,$ctg);
                            $fetch = mysqli_fetch_array($ctg2);
                        
                            $nom=$_POST["nom"];
                            $artiste=$_POST["artiste"];
                            $type=$_POST["type"];
                            $des=$_POST["des"];
                            $img=$_POST["image"];
                            $prix=$_POST["prix"];
                            $categorie=$fetch["id"];

                            $requete = "INSERT INTO `produits` (`nom`,`artiste`,`type`, `description`, `image`,`prix`,`id_categories`) 
                            VALUES ('".$nom."','".$artiste."', '".$type."', '".$des."','".$img."','".$prix."','".$categorie."')";  
                            $query = mysqli_query($connexion, $requete);


                        }	
                        ?>
                    </div>
            </section>
            <section>
            <form class="forme" method="post" action="">
                    <fieldset>
                        <legend>Supprimer un utilisateur</legend>
                            <input type="text" name="utilisateur"/>
                            <input type="submit" name="supp" value="supprimer"/>
                    </fieldset>
                </form>

                <?php
                    if(isset($_POST['supp']))
                    {
						$base = mysqli_connect("localhost", "root", "", "boutique");
						$utilisateur=$_POST['utilisateur'];
						$dele="DELETE FROM `utilisateurs` WHERE login='$utilisateur'";
						$quer= mysqli_query($base,$dele);
                        echo "<p class='bug'>$utilisateur supprimée avec succès !</p>";

                    }
                    ?>
                </section>
                <section>
                <form class="forme" method="post" action="">
                    <fieldset>
                        <legend>Supprimer un produit</legend>
                            <input type="text" name="ref"/>
                            <input type="submit" name="suppu" value="supprimer"/>
                    </fieldset>

                </form>
                    <?php
                    if(isset($_POST['suppu']))
                    {
						$base = mysqli_connect("localhost", "root", "", "boutique");
						$refe=$_POST['ref'];
                        $noms="SELECT * FROM `produits` WHERE reference='$refe'";
                        $que= mysqli_query($base,$noms);
                        $fech = mysqli_fetch_array($que);
                        $no=$fech["nom"];
                        echo "<p class='bug'>$no supprimée avec succès !</p>";


						$delet="DELETE FROM `produits` WHERE reference='$refe'";
                        $quer= mysqli_query($base,$delet);



                    }
                    ?>
                </section>
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


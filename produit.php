<html>
	<head>
		<meta charset="utf-8">
        <title>produits</title>
    

        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/flaticon.css">
    <link rel="stylesheet" href="assets/css/style.css">
	</head>
	<body>
    <header class="topnav">
			<nav id="menu">
                <ul> <?php include('header.php') ;
                    require "class/produit.php";
                    $produit = new Produit($connexion);
                    $types = $produit->getType();
                    $artistes = $produit->getArtiste();
                    ?>
                </ul>				
		</header>
        <main>
            <div class="cherche">
                <form method="get" action="">Rechercher un produit : 
                    <input type="text" name="recherche" placeholder="nom,type,artiste">
                    <input type="SUBMIT" value="Search!"> 
                </form>
            </div>
           
            <div class="flexi">
                <form action="#">
                    <nav class="menus">
                        <ul>
                            <li class="deroulant"><a href="#">Artiste</a>
                                <ul class="sous">
                                 <?php
                                    foreach ($artistes as $artiste)
                             { echo'<li><a href="produit.php?art=',$artiste,'">'.$artiste.'</a></li>'; }
                                  ?>    
                                </ul>
                            </li>
                        </ul>  
                    </nav> 
                </form>
                
                <form action="#">
                    <nav class="menus">
                        <ul>
                            <li class="deroulant"><a href="#">Type</a>
                                <ul class="sous">
                                <?php
                                foreach ($types as $type)
                                {echo'<li><a href="produit.php?type=' , $type , '">'.$type.'</a></li>';}
                                ?>    
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </form>
            </div>
               
        <?php
                if(isset($_GET['recherche']))
                    {
                        $limite = 6;
                        if (isset($_GET["page"]))
                        {
                            $page  = $_GET["page"];
                        }
                        else
                        { 
                            $page=1;
                        }		
                        $debut = ($page-1) * $limite;  
                        $recherche=$_GET['recherche'];
                        $chersc="SELECT * FROM produits WHERE nom LIKE'%$recherche%'  or artiste LIKE'%$recherche%' or
                        type LIKE'%$recherche%' ORDER BY reference LIMIT $debut, $limite ";
                        $cherscs=mysqli_query($connexion,$chersc);
                        $verif = mysqli_num_rows($cherscs);
                        $pg = "SELECT COUNT(reference) FROM produits where nom LIKE'%$recherche%'  or artiste LIKE'%$recherche%' or
                        type LIKE'%$recherche%'";
                        $pg2 = mysqli_query($connexion, $pg);
                        $row = mysqli_fetch_row($pg2);
                        $total = $row[0];
                        $total_pages = ceil($total / $limite);
                        
                        if($verif != 0)
                        {
                            $shear = htmlspecialchars($_GET['recherche']);
                            while($donnees = mysqli_fetch_array($cherscs)) 
                            {
                                $ctgr=$donnees["id_categories"];
                                $ctg="SELECT * FROM categories where id='$ctgr'";
                                $ct = mysqli_query($connexion,$ctg);
                                $cti = mysqli_fetch_array($ct);

                                echo'<h2>'.$donnees["nom"].'</h2>'. $cti["nom"].' ('.$donnees["type"].') '.$donnees["artiste"].''; 
                                echo'<section class="versement">';
                                echo'<aside class="imge"><img class="im" src="'.$donnees['image'].'"/></aside>';      
                                echo'<article class="art">'.substr(nl2br($donnees["description"]),0,370).'';
                                echo'<a href="produit.php?id='.$donnees['reference'].'">... (fiche produit) </a>';
                                echo '<p class="prix">'.$donnees["prix"].'€</p>';
                                echo'</article></section>';	
                            }
                        }
                        for ($i=1; $i<=$total_pages; $i++)
                        {   
                            if (isset($_GET["recherche"]))
                            {
                                echo "<ul id='pagination-flickr'>";
                                echo"<li><a href='produit.php?page=".$i."&amp;recherche=".$_GET["recherche"]."'>".$i."</a></section>";
                            }
                            else
                            {
                                echo "<ul id='pagination-flickr'>";
                                echo"<li><a href='produit.php?page=".$i."'>".$i."</a></li></ul>"; 
				           	} 
                          } 
    
                    }                
                elseif(isset($_GET["art"]))
                    {
                        $limite = 6;
                        if (isset($_GET["page"]))
                        {
                            $page  = $_GET["page"];
                        }
                        else
                        { 
                            $page=1;
                        }		
                            $debut = ($page-1) * $limite;  
                            $art= $_GET['art'];
                            $uti = "SELECT * FROM produits wHERE  artiste='$art' ORDER BY reference DESC LIMIT $debut, $limite ";
                            $uti2 = mysqli_query($connexion,$uti);
                            $uti3 = mysqli_fetch_array($uti2);
                            $ctgr=$uti3["id_categories"];
                            $ctg="SELECT * FROM categories where id='$ctgr'";
                            $ct = mysqli_query($connexion,$ctg);
                            $cti = mysqli_fetch_array($ct);
                            $pg = "SELECT COUNT(reference) FROM produits where artiste='$art'";
					        $pg2 = mysqli_query($connexion, $pg);
					        $row = mysqli_fetch_row($pg2);
					        $total = $row[0];
					        $total_pages = ceil($total / $limite);

                        $uti = 'SELECT * FROM produits WHERE artiste="'.$_GET['art'].'" ';
                        $uti2 = mysqli_query($connexion,$uti);
                        while ($data = mysqli_fetch_array($uti2))
                        {        
                            echo'<h2>'.$data["nom"].'</h2>'. $cti["nom"].' ('.$data["type"].') '.$data["artiste"].''; 
                            echo'<section class="versement">';
                            echo'<aside class="imge"><img class="im" src="'.$data['image'].'"/></aside>';      
                            echo'<article class="art">'.substr(nl2br($data["description"]),0,370).'';
                            echo'<a href="produit.php?id='.$data['reference'].'">... (fiche produit) </a>';
                            echo '<p class="prix">'.$data["prix"].'€</p>';
                            echo'</article></section>';	
                        }
                        for ($i=1; $i<=$total_pages; $i++)
                        {
                            if (isset($_GET["art"]))
                            {
                                echo "<ul id='pagination-flickr'>";
                                echo"<li><a href='produit.php?page=".$i."&amp;art=".$_GET["art"]."'>".$i."</a></section>";
                            }
                            else
                            {
                                echo "<ul id='pagination-flickr'>";
                                echo"<li><a href='produit.php?page=".$i."'>".$i."</a></li></ul>"; 
				           	} 
                        }
                    }

                elseif (isset($_GET["ctg"]))
                    { 
                        $limite = 6;
                        if (isset($_GET["page"]))
                        {
                            $page  = $_GET["page"];
                        }
                        else
                        { 
                            $page=1;
                        }		
                            $debut = ($page-1) * $limite;     
                            $id= $_GET['ctg'];
                            $uti = "SELECT * FROM produits wHERE  id_categories='$id' ORDER BY reference DESC LIMIT $debut, $limite ";
                            $uti2 = mysqli_query($connexion,$uti);
                            $uti3 = mysqli_fetch_array($uti2);
                            $ctgr=$uti3["id_categories"];
                            $ctg="SELECT * FROM categories where id='$ctgr'";
                            $ct = mysqli_query($connexion,$ctg);
                            $cti = mysqli_fetch_array($ct);
                            $pg = "SELECT COUNT(reference) FROM produits where id_categories='$id'";
					        $pg2 = mysqli_query($connexion, $pg);
					        $row = mysqli_fetch_row($pg2);
					        $total = $row[0];
					        $total_pages = ceil($total / $limite);

				        while ($data = mysqli_fetch_array($uti2))
                        {  
                            echo'<h2>'.$data["nom"].'</h2>'. $cti["nom"].' ('.$data["type"].') '.$data["artiste"].''; 
                            echo'<section class="versement">';
                            echo'<aside class="imge"><img class="im" src="'.$data['image'].'"/></aside>';      
                            echo'<article class="art">'.substr(nl2br($data["description"]),0,370).'';
                            echo'<a href="produit.php?id='.$data['reference'].'">... (fiche produit) </a>';
                            echo '<p class="prix">'.$data["prix"].'€</p>';
                            echo'</article></section>';	
                        }
                        for ($i=1; $i<=$total_pages; $i++)
                        {
                            if (isset($_GET["ctg"]))
                            {
                                echo "<ul id='pagination-flickr'>";
                                echo"<li><a href='produit.php?page=".$i."&amp;ctg=".$_GET["ctg"]."'>".$i."</a></section>";
                            }
                            else
                            {
                                echo "<ul id='pagination-flickr'>";
                                echo"<li><a href='produit.php?page=".$i."'>".$i."</a></li></ul>"; 
				           	} 
                        }
                                              
                    }   
                    elseif(isset($_GET["type"]))
                    {   
                        $limite = 6;
                        if (isset($_GET["page"]))
                        {
                            $page  = $_GET["page"];
                        }
                        else
                        { 
                            $page=1;
                        }		
                            $debut = ($page-1) * $limite;  
                            $type= $_GET['type'];
                            $uti = "SELECT * FROM produits wHERE  type='$type' ORDER BY reference DESC LIMIT $debut, $limite ";
                            $uti2 = mysqli_query($connexion,$uti);
                            $uti3 = mysqli_fetch_array($uti2);
                            $ctgr=$uti3["id_categories"];
                            $ctg="SELECT * FROM categories where id='$ctgr'";
                            $ct = mysqli_query($connexion,$ctg);
                            $cti = mysqli_fetch_array($ct);
                            $pg = "SELECT COUNT(reference) FROM produits where type='$type'";
					        $pg2 = mysqli_query($connexion, $pg);
					        $row = mysqli_fetch_row($pg2);
					        $total = $row[0];
					        $total_pages = ceil($total / $limite);


                        $uti = 'SELECT * FROM produits WHERE type="'.$_GET['type'].'" ';
                        $uti2 = mysqli_query($connexion,$uti); 
                        while ($data = mysqli_fetch_array($uti2))
                            { 
                                echo'<h2>'.$data["nom"].'</h2>'. $cti["nom"].' ('.$data["type"].') '.$data["artiste"].''; 
                            echo'<section class="versement">';
                            echo'<aside class="imge"><img class="im" src="'.$data['image'].'"/></aside>';      
                            echo'<article class="art">'.substr(nl2br($data["description"]),0,370).'';
                            echo'<a href="produit.php?id='.$data['reference'].'">... (fiche produit) </a>';
                            echo '<p class="prix">'.$data["prix"].'€</p>';
                            echo'</article></section>';		
                            }
                            for ($i=1; $i<=$total_pages; $i++)
                            {
                                if (isset($_GET["type"]))
                                {
                                    echo "<ul id='pagination-flickr'>";
                                    echo"<li><a href='produit.php?page=".$i."&amp;type=".$_GET["type"]."'>".$i."</a></section>";
                                }
                                else
                                {
                                    echo "<ul id='pagination-flickr'>";
                                    echo"<li><a href='produit.php?page=".$i."'>".$i."</a></li></ul>"; 
                                   } 
                            }
                              
                    }
                    elseif (isset($_GET["id"]))
				    { 
				        $uti = 'SELECT * FROM produits WHERE reference="'.$_GET['id'].'" ';
                        $uti2 = mysqli_query($connexion,$uti);
                        
                        while ($data = mysqli_fetch_array($uti2))
                            {
                                echo'<section class="sectio">';
                                echo'<aside class="asid"><img class="im" width="200" src="'.$data['image'].'"/></aside>';	
                                echo'<article class="articl"><h2 class="titreb">'.$data["nom"].'('.$data["type"].') '.$data["prix"].'€</h2>';
                                echo'<p>'.nl2br($data["description"]).'</p></article></section>';
                                if (isset($_SESSION['login']))
                                {
                                    echo'<a class="nierpa" href="panier.php?id='.$_GET['id'].'">Ajouter au panier </a>';
                                }
                                else
                                {
                                    echo'<a class="nierpa" href="connexion.php?id='.$_GET['id'].'">Ajouter au panier </a>';

                                }
?>
                               <section class="act">
                        
					        <?php include('Commentaire.php') ?>
				
                                </section>
                                <section>
                            <?php
                           }
                    }
                    else
                    {
                        $limite = 6;
                        if (isset($_GET["page"]))
                        {
                            $page  = $_GET["page"];
                        }
                        else
                        { 
                            $page=1;
                        }		
                            $debut = ($page-1) * $limite;     
                
                        $uti = "SELECT * FROM produits ORDER BY reference DESC LIMIT $debut, $limite ";
                        $uti2 = mysqli_query($connexion,$uti);
                        $uti3 = mysqli_fetch_array($uti2);
                        $ctgr=$uti3["id_categories"];
                        $ctg="SELECT * FROM categories where id='$ctgr'";
                        $ct = mysqli_query($connexion,$ctg);
                        $cti = mysqli_fetch_array($ct);
                        $pg = "SELECT COUNT(reference) FROM produits";
					    $pg2 = mysqli_query($connexion, $pg);
					    $row = mysqli_fetch_row($pg2);
					    $total = $row[0];
					    $total_pages = ceil($total / $limite);

                        while($data = mysqli_fetch_array($uti2))
                        {
                            echo'<h2>'.$data["nom"].'</h2>'. $cti["nom"].' ('.$data["type"].') '.$data["artiste"].''; 
                            echo'<section class="versement">';
                            echo'<aside class="imge"><img class="im" src="'.$data['image'].'"/></aside>';      
                            echo'<article class="art">'.substr(nl2br($data["description"]),0,370).'';
                            echo'<a href="produit.php?id='.$data['reference'].'">... (fiche produit) </a>';
                            echo '<p class="prix">'.$data["prix"].'€</p>';
                            echo'</article></section>';							  
                        }

                           for ($i=1; $i<=$total_pages; $i++)
                           {   
                               echo "<ul id='pagination-flickr'>";

                               echo"<li><a href='produit.php?page=".$i."'>".$i."</a></li></ul>"; 

				         	} 
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
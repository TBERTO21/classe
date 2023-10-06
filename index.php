<html>
	<head>
		<meta charset="utf-8">
		<title>index</title>

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/flaticon.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="styles/main_styles.css">
<link rel="stylesheet" type="text/css" href="styles/responsive.css">
</head>
	</head>

    <body>
        <header> 
            <nav>
                <ul>
                    <?php include('header.php');
                    require "class/produit.php";
                    $produit = new Produit($connexion);
                    $produits = $produit->recupererProduits();
                    $count = 0;

                    ?>
                </ul>
            </nav>
        </header>

        <main> 
		<div class="slider-area ">
            <div class="slider-active">
                <!-- Single Slider -->
                <div class="single-slider slider-height d-flex align-items-center slide-bg">
                    <div class="container">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8">
                                <div class="hero__caption">
                                    <h1 data-animation="fadeInLeft" data-delay=".4s" data-duration="2000ms">Select Your Favorite Music</h1>
                                    <p data-animation="fadeInLeft" data-delay=".7s" data-duration="2000ms">Une multitude d'album disponnible pour vous.</p>
                                    <!-- Hero-btn -->
                                    <div class="hero__btn" data-animation="fadeInLeft" data-delay=".8s" data-duration="2000ms">
                                        <a href="produit.php" class="btn hero-btn">Shop Now</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-4 d-none d-sm-block">
                                <div class="hero__img" data-animation="bounceIn" data-delay=".4s">
                                    <img src="disque.jpg" alt="" height="370px"  class=" heartbeat">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            
            </div>
        </div>
            <h2 class="titre">Dernier article ajouter</h2>
		<div class="flex">
        <?php
        $produitsPremiers = array_slice($produits, 0, 3); 
        $produitsSuivants = array_slice($produits, 3, 3); 
        
        foreach ($produitsPremiers as $data) {

            echo'<section class="divi">';
            echo'<p><a class="lien" href  ="produit.php?id=' , $data['reference'] , '">'.$data["nom"].'</p>';
			echo' <img class="im" src="'.$data['image'].'" alt=""></a>';
			echo'<p> ' .$data["prix"].'€</p>	</section>';}
							   
							
                           
                           echo'</div>';
                           echo'<div class="flex">';
                           foreach ($produitsSuivants as $data2)
                           {
                                    echo'<section class="divi">'; 
                                    echo'<p><a class="lien" href  ="produit.php?id=' , $data2['reference'] , '">'.$data2["nom"].'</p>';
                                    echo' <img class="im" src="'.$data2['image'].'" alt=""></a>';
                                    echo'<p> ' .$data2["prix"].'€</p>	</section>';                                   
                            }
                                echo'</div>'; 
		?>                             
              
            <div class="ind">         
					<div class="icon_box">
						<div class="icon_box_image"><img src="icon_1.svg"  width="150" alt=""></div>
						<div class="icon_box_title"><p class="t">Free Shipping Worldwide</p></div>
						<div class="icon_box_text">
							<p>Livraison gratuite partout dans le monde a partir de 50€ et assuré le plus rapidement possible par nos livreurs</p>
						</div>
					</div>

				<!-- Icon Box -->
					<div class="icon_box">
                        <div class="icon_box_image"><img src="icon_2.svg" width="150" alt=""></div>
						<div class="icon_box_title"><p class="t">Free Returns</p></div>
						<div class="icon_box_text">
							<p>En cas de problème, le retour est gratuit dans un delais d'un mois.Votre remboursement sera effectué apres reception de l'article.  </p>
						</div>
				    </div>

				<!-- Icon Box -->
					<div class="icon_box">
						<div class="icon_box_image"><img src="icon_3.svg"  width="150" alt=""></div>
                        <div class="icon_box_title"><p class="t">24h Fast Support</p></div>
						<div class="icon_box_text">
							<p>Notre service client se tient à votre dispotion 24h/24 7j/7 afin de vous accompagner lors de votre shopping. </p>
						</div>
                    </div>
            </div>



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
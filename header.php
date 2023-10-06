<?php

session_start();
$connexion = mysqli_connect("localhost", "root", "", "classe");
mysqli_set_charset ($connexion,'utf8');
require "class/header.php"; // Inclure la classe Header
 $header = new Header($connexion);
if (isset($_SESSION['login'])) 

{
    $login = $_SESSION['login'];    
    $idut = $header->getId($connexion, $login);
    $sa = $header-> getGrade($connexion, $login);
    
    

?>
 <div class="header-area">
            <div class="main-header header-sticky">
                <div class="container-fluid">
                    <div class="menu-wrapper">
                        <!-- Logo -->
                        <div class="logo">
                            <a href="index.php"><img src="assets/img/logo/logo.png" alt=""></a>
                        </div>
                        <!-- Main-menu -->
                        <div class="main-menu d-none d-lg-block">
                            <nav>                                                
                                <ul id="navigation">  
                                    <li><a href="index.php">Home</a></li>
                                    <li><a href="produit.php">shop</a></li>
                                    <?php
                                    if($sa == 21 OR $sa == 28)
                                    {
                                        echo '<li><a href="admin.php">Admin</a></li>';
                                    }
                                    ?>                               
                                    <li><a href="#">categories</a>
                                    <ul class="submenu">
       <?php
        $header->Categories(); 
                                ?>
    </ul>
                                    </li>                                    
                                    <li><a href="compte.php">Mon compte</a></li><li>
                                        <form action="index.php" method="post">
                                            <input type="submit" name='deconnexion' class="deco" value="deconnexion">
                                        </form>
                                    <?php if (isset($_POST['deconnexion'])) 
                                    {
                                        $header->deconnexion($connexion, $idut);
                                        exit;
                                    }
                                    ?>
                                    </li>

                                </ul>
                            </nav>
                        </div>
                        <!-- Header Right -->
                        <div class="header-right">
                            <ul>
                                <li>
                                    <div class="nav-search search-switch">
                                    <a href="produit.php"><span class="flaticon-search"></span></a>
                                    </div>
                                </li>
                                <li> <a href="profil.php"><span class="flaticon-user"></span></a></li>

                                <li><a href="vpanier.php"><span class="flaticon-shopping-cart">
                                <?php
        if ($idut !== null) {
            // Utilisez la méthode getPanier pour obtenir la quantité d'articles dans le panier
            $qPanier = $header->getPanier($connexion, $idut);
    
            echo  $qPanier;

        }
 ?>
                                </span></a> </li>
                            </ul>
                        </div>
                    </div>
                    <!- - Mobile Menu -->
                    <div class="col-12">
                        <div class="mobile_menu d-block d-lg-none"></div>
                    </div>
                </div>
            </div>
        </div>



        <?php } else { ?>
 <div class="header-area">
            <div class="main-header header-sticky">
                <div class="container-fluid">
                    <div class="menu-wrapper">
                        <!-- Logo -->
                        <div class="logo">
                            <a href="index.php"><img src="assets/img/logo/logo.png" alt=""></a>
                        </div>
                        <!-- Main-menu -->
                        <div class="main-menu d-none d-lg-block">
                            <nav>                                                
                                <ul id="navigation">  
                                    <li><a href="index.php">Home</a></li>
                                    <li><a href="connexion.php">Connexion</a></li>
                                    <li><a href="Inscription.php">Inscription</a></li>
                                    <li><a href="produit.php">shop</a></li>
                                    <li><a href="#">categories</a>
                                        <ul class="submenu">
                                      <?php
                                             $header->Categories(); 

                                        ?>      
                                        </ul>
                                        </ul>
                            </nav>
                        </div>
                        <!-- Header Right -->
                        <div class="header-right">
                            <ul>
                                <li>
                                    <div class="nav-search search-switch">
                                        <a href="produit.php"><span class="flaticon-search"></span></a>
                                    </div>
                                </li>
                                <li> <a href="profil.php"><span class="flaticon-user"></span></a></li>

                                <li><a href="vpanier.php"><span class="flaticon-shopping-cart">
 
                                </span></a> </li>
                            </ul>
                        </div>
                    </div>
                    <!-- Mobile Menu -->
                    <div class="col-12">
                        <div class="mobile_menu d-block d-lg-none"></div>
                    </div>
                </div>
            </div>
        </div>





 
        <?php } ?>

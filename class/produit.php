<?php
    class produit 
    {
        private $host = "localhost";
		private $username = "root";
		private $password = "";
        private $db = "classe";

         public function recupererProduits()
        {
            $connexion = mysqli_connect($this->host, $this->username, $this->password, $this->db);
            $uti = "SELECT * FROM produits ORDER BY reference DESC LIMIT 6";

            $util = mysqli_query($connexion, $uti);

            $produits = [];
    
            while ($data = mysqli_fetch_array($util)) {
                $produits[] = $data;
            }
           
            return $produits;
        }


        public function getType()
    {
        $connexion = mysqli_connect($this->host, $this->username, $this->password, $this->db);
        $sql = "SELECT DISTINCT type FROM produits";
        $result = mysqli_query($connexion, $sql);
        $types = [];

        while ($data = mysqli_fetch_array($result)) {
            $types[] = $data['type'];
        }

        return $types;
    }

    public function getArtiste()
    {
        $connexion = mysqli_connect($this->host, $this->username, $this->password, $this->db);
        $sql = "SELECT DISTINCT artiste FROM produits";
        $result = mysqli_query($connexion, $sql);
        $artistes = [];

        while ($data = mysqli_fetch_array($result)) {
            $artistes[] = $data['artiste'];
        }

        return $artistes;
    }

    public function recupererProduitsPage($limite, $page = 1, $recherche = null, $artiste = null, $type = null) {
        $debut = ($page - 1) * $limite;
        $sql = "SELECT * FROM produits WHERE 1 ";
        if (!empty($recherche)) {
            $sql .= " AND (nom LIKE '%$recherche%' OR artiste LIKE '%$recherche%' OR type LIKE '%$recherche%') ";
        }
         if (!empty($artiste)) {
            $sql .= " AND artiste = '$artiste' ";
        }if (!empty($type)) {
            $sql .= " AND type = '$type' ";
        }
        $sql .= " ORDER BY reference DESC LIMIT $debut, $limite ";
        $result = mysqli_query($connexion, $sql);
        $produits = [];
        while ($data = mysqli_fetch_array($result)) {
            $produits[] = $data;
        }

        return $produits;
    }


    }
    ?>
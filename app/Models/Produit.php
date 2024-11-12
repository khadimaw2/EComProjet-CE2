<?php 
    namespace App\Models; 

    class Produits {
        private $id; 
        private $nom; 
        private $prixUnitaire; 
        private $description;
        private $courteDescription;
        private $quantite; 
        private $id_categorie;
    
        // Constructeur
        public function __construct($id=null,$nom, $prixUnitaire, $description, $courteDescription, $quantite, $id_categorie) {
            $this->nom = $nom;
            $this->prixUnitaire = $prixUnitaire;
            $this->description = $description;
            $this->courteDescription = $courteDescription;
            $this->quantite = $quantite;
            $this->id_categorie = $id_categorie;
            $this->$id = $id ;

        }
    
        // Getters
        public function getId() {
            return $this->id;
        }
    
        public function getNom() {
            return $this->nom;
        }
    
        public function getPrixUnitaire() {
            return $this->prixUnitaire;
        }
    
        public function getDescription() {
            return $this->description;
        }
    
        public function getCourteDescription() {
            return $this->courteDescription;
        }
    
        public function getQuantite() {
            return $this->quantite;
        }
    
        public function getIdCategorie() {
            return $this->id_categorie;
        }
    
        // Setters
        public function setId($id) {
            $this->id = $id;
        }
    
        public function setNom($nom) {
            $this->nom = $nom;
        }
    
        public function setPrixUnitaire($prixUnitaire) {
            $this->prixUnitaire = $prixUnitaire;
        }
    
        public function setDescription($description) {
            $this->description = $description;
        }
    
        public function setCourteDescription($courteDescription) {
            $this->courteDescription = $courteDescription;
        }
    
        public function setQuantite($quantite) {
            $this->quantite = $quantite;
        }
    
        public function setIdCategorie($id_categorie) {
            $this->id_categorie = $id_categorie;
        }
    }

?>
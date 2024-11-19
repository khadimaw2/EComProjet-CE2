<?php 
    namespace App\Models; 

    class Produit {
        private int $id; 
        private string $nom; 
        private $prixUnitaire; 
        private string $description;
        private string $courteDescription;
        private string $quantite; 
        private int $idCategorie;
        private string $nomCategorie;
        private string $cheminImage ; 
    
        // Constructeur
        public function __construct($id,$nom, $prixUnitaire, $description, $courteDescription, $quantite, $idCategorie,$nomCategorie,$cheminImage) {
            $this->id = $id ;
            $this->nom = $nom;
            $this->prixUnitaire = $prixUnitaire;
            $this->description = $description;
            $this->courteDescription = $courteDescription;
            $this->quantite = $quantite;
            $this->idCategorie = $idCategorie;
            $this->nomCategorie = $nomCategorie;
            $this->cheminImage = $cheminImage ; 
        }

            // Méthode statique pour créer un produit à partir d'un tableau
        public static function InitialiserAvecTableau(array $donnee): self {
            return new self(
                $donnee['id'] ?? 0,
                $donnee['nom'], 
                $donnee['prix_unitaire'], 
                $donnee['description'], 
                $donnee['courte_description'], 
                $donnee['quantite'], 
                $donnee['id_categorie'] ?? 0,
                $donnee['nom_categorie'] ??  '',
                $donnee['chemin_image'] ??  ''
            );
        }

        public static function creerObjetVide(): self {
            return new self(0, '', 0, '', '', '', 0, '', '');
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
            return $this->idCategorie;
        }

        public function getNomCategorie() {
            return $this->nomCategorie;
        }

        public function getcheminImage() {
            return $this->cheminImage;
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
    
        public function setIdCategorie($idCategorie) {
            $this->idCategorie = $idCategorie;
        }
    }

?>
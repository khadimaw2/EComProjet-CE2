<?php 
    namespace App\Controllers;

    use App\Models\Produit;
    use App\Services\ProduitService;
    use App\Services\GestionnaireErreur;
    use Exception;

    class DetailsProduitController{
        private $produitService;

        public function __construct(){
            $this->produitService = new ProduitService() ;
        }

        //Affichage des details du produit
        public function afficherDetailsProduit($produit){
            include __DIR__ . '/../Views/detailsProduitView.php';
        }
    }
?>
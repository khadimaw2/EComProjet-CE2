<?php 
    namespace App\Controllers;

    use App\Services\ProduitService; 
    use Exception;
    use App\Services\GestionnaireErreur;

    class StoreController {

        private $produitService;

        public function __construct() {
            $this->produitService = new ProduitService();
        }

        private function calculerQuantiteTotalePanier() {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $totalQuantite = 0;
            if (isset($_SESSION['panier']) && !empty($_SESSION['panier'])) {
                foreach ($_SESSION['panier'] as $produit) {
                    $totalQuantite += $produit->getQteDansLePanier();
                }
            }
            return $totalQuantite;
        }
        

        // Affiche la boutique
        public function afficherStore() {
            try {
                $produits = $this->produitService->recupererTousLesProduits();
                $qteProduitDansLePanier = $this->calculerQuantiteTotalePanier();

                if (!empty($produits)) {
                    include __DIR__ . '/../Views/storeView.php';
                } else {
                    throw new Exception("La boutique n'a pas de produit");
                }

            } catch (Exception $e) {
                GestionnaireErreur::redirigerVersErreurPage($e->getMessage());
            }
        }
    }
?>
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

        // Ajout d'un produit au panier
        public function ajouterAuPanier($idProduit) {
            try {
                // Validation de l'ID du produit
                if (!is_numeric($idProduit) || $idProduit <= 0) {
                    throw new Exception("ID du produit invalide.");
                }

                $produit = $this->produitService->recupererProduitParId($idProduit);
                if (!$produit) {
                    throw new Exception("Le produit avec l'ID $idProduit n'existe pas.");
                }

                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }

                if (!isset($_SESSION['panier'])) {
                    $_SESSION['panier'] = [];
                }

                $this->ajoutOuMajPanier($idProduit, $produit);
                
    
                header("Location: ../publics/panier.php");
                exit;
            } catch (Exception $e) {
                GestionnaireErreur::redirigerVersErreurPage($e->getMessage());
            }
        }

        //Ajout ou maj du panier
        private function ajoutOuMajPanier($idProduit, $produit){
            if (!isset($_SESSION['panier'][$idProduit])) {
                $_SESSION['panier'][$idProduit] = $produit;
                $_SESSION['panier'][$idProduit]->setQteDansLePanier(1);
            } else {
                $qteActuelle = $_SESSION['panier'][$idProduit]->getQteDansLePanier();
                $_SESSION['panier'][$idProduit]->setQteDansLePanier($qteActuelle + 1);
            }
        }

    }
?>
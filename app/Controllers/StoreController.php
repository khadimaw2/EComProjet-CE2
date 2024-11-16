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

    // Affiche la boutique
    public function afficherStore() {
        try {
            $produits = $this->produitService->recupererTousLesProduits();

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

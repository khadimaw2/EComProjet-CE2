<?php 
namespace App\Controllers;

use App\Services\ProduitService; 
use Exception;
use App\Services\GestionnaireErreur;

class ListeProduitsController {
    private $produitService;

    public function __construct() {
        $this->produitService = new ProduitService();
    }

     //Affiche la vue du formulaire 
    public function afficherListeProduits(){
        try {
            $produits = $this->produitService->recupererTousLesProduits();

            if (!empty($produits)) {
                include __DIR__ . '/../Views/listeProduitsView.php';
            } else {
                throw new Exception("La boutique n'a pas de produit");
            }

        } catch (Exception $e) {
            GestionnaireErreur::redirigerVersErreurPage($e->getMessage());
        }
    }

    public function supprimerProduit($idProduit) {
        try {
            if (!is_numeric($idProduit) || $idProduit <= 0) {
                throw new Exception("ID du produit invalide.");
            }
    
            $this->produitService->supprimerProduit($idProduit);
        } catch (Exception $e) {
            GestionnaireErreur::redirigerVersErreurPage($e->getMessage());
        }
    }
    
    

}
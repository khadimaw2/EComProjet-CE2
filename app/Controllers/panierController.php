<?php 
namespace App\Controllers;

use App\Models\Produit; 
use Exception;
use App\Services\GestionnaireErreur;

class PanierController {
    private $produit;

     //Affiche la vue du formulaire 
    public function afficherContenuPanier(){
        
        $panier = $_SESSION['panier'] ;
        $totalAPayer = 0;
        include __DIR__ . '/../Views/panierView.php';

    }

   // Modifier la quantité d'un produit dans le panier
    public function modifierQteProduit($idProduit, $action) {
        try {
            if (!isset($_SESSION['panier'][$idProduit])) {
                throw new Exception("Le produit avec l'ID $idProduit n'est pas dans le panier.");
            }
            $qteActuelProduit = $_SESSION['panier'][$idProduit]->getQteDansLePanier();


            if ($action === 'diminuer') {
                $qteActuelProduit--;
                if ($qteActuelProduit <= 0) {
                    unset($_SESSION['panier'][$idProduit]);
                    $_SESSION['message'] = "Le produit a été retiré du panier.";
                } else {
                    $_SESSION['panier'][$idProduit]->setQteDansLePanier($qteActuelProduit);
                    $_SESSION['message'] = "Quantité du produit diminuée.";
                }
            } elseif ($action === 'augmenter') {
                $qteActuelProduit++;
                $_SESSION['panier'][$idProduit]->setQteDansLePanier($qteActuelProduit);
                $_SESSION['message'] = "Quantité du produit augmentée.";
            } else {
                // Action invalide
                throw new Exception("Action invalide pour la modification de la quantité.");
            }

            // Redirection vers la page panier
            header("Location: ../publics/panier.php");
            exit;
        } catch (Exception $e) {
            GestionnaireErreur::redirigerVersErreurPage($e->getMessage());
        }
    }



    public function supprimerDuPanier($idProduit){
        try {
            unset($_SESSION['panier'][$idProduit]);
        } catch (Exception $e) {
            GestionnaireErreur::redirigerVersErreurPage($e->getMessage());
        }
        
    }



    
    
    

}
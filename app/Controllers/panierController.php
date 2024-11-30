<?php 
namespace App\Controllers;

use App\Models\Commande;
use App\Services\CommandeService;
use App\Models\Produit; 
use Exception;
use App\Services\GestionnaireErreur;

class PanierController {
    private $commandeService;

    public function __construct() {
        $this->commandeService = new CommandeService();
    }

     //Affiche la vue du formulaire 
    public function afficherContenuPanier($errors = []){ 
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
                } else {
                    $_SESSION['panier'][$idProduit]->setQteDansLePanier($qteActuelProduit);
                }
            } elseif ($action === 'augmenter') {
                $qteActuelProduit++;
                $_SESSION['panier'][$idProduit]->setQteDansLePanier($qteActuelProduit);
            } else {
                throw new Exception("Action invalide pour la modification de la quantité.");
            }
            header("Location: ../publics/panier.php");
            exit;
        } catch (Exception $e) {
            GestionnaireErreur::redirigerVersErreurPage($e->getMessage());
        }
    }

    // Supprimer un produit de panier
    public function supprimerDuPanier($idProduit){
        try {
            unset($_SESSION['panier'][$idProduit]);
        } catch (Exception $e) {
            GestionnaireErreur::redirigerVersErreurPage($e->getMessage());
        }
        
    }

    //Calcule le nombre totale de produit dans le panier
    private function calculerQteProduitsProduit() :int{
        try{
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
    
            if (!isset($_SESSION['panier']) || empty($_SESSION['panier'])) {
               throw new Exception("Le panier est vide pu n'existe pas", 1); 
            }
    
            $totalQuantite = 0;
            if (isset($_SESSION['panier']) && !empty($_SESSION['panier'])) {
                foreach ($_SESSION['panier'] as $produit) {
                    $totalQuantite += $produit->getQteDansLePanier();
                }
            }
    
            return $totalQuantite;
        }catch(Exception $e){
            GestionnaireErreur::redirigerVersErreurPage($e->getMessage());
        }
        
    }

    //Validation de la commande
    public function passerCommande($idUtilisateur, $prixTotal): void {
        try {
            $qteProduit = $this->calculerQteProduitsProduit();
            $date = date("Y-m-d H:i:s");
            $commande = new Commande(0,$date, $qteProduit, $prixTotal, $idUtilisateur, $_SESSION['panier'],0);
            $errors = $this->commandeService->traiterCommande($commande);
    
            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
                $this->afficherContenuPanier($errors);
                exit;
                return;
            }
            else {
                unset( $_SESSION['errors']);
                $_SESSION['panier'] = [];
                header("Location: ../publics/panier.php");
                exit;
            }
        } catch (Exception $e) {
            GestionnaireErreur::redirigerVersErreurPage($e->getMessage());
        }
    }
    

}
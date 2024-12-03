<?php 
namespace App\Controllers;

use App\Models\Commande;
use Exception;
use App\Services\CommandeService;
use App\Services\GestionnaireErreur;

class   ToutesLesCommandesController {
    private $commandeService;

    public function __construct() {
        $this->commandeService = new CommandeService();
    }

     //Affiche la vue de la liste des commandes 
    public function afficherTouteLesCommandes(){
        try {
            $commandes = $this->commandeService->recupererToutesLesCommandes();

            include __DIR__ . '/../Views/toutesLesCommandesView.php';

        } catch (Exception $e) {
            GestionnaireErreur::redirigerVersErreurPage($e->getMessage());
        }
    }

    //Confirmer la livraison d'une commande
    public function confirmerLivraison($idCommande){
        try {
            if (!is_numeric($idCommande) || $idCommande<= 0) {
                throw new Exception("ID de la commande invalide.");
            }
            $this->commandeService->confirmerLivraison($idCommande); 
        } catch (Exception $e) {
            GestionnaireErreur::redirigerVersErreurPage($e->getMessage());
        }

    }

    //Reinitaliser la livraison d'une commande
    public function reinitialiserLivraison($idCommande){
        try {
            if (!is_numeric($idCommande) || $idCommande<= 0) {
                throw new Exception("ID de la commande invalide.");
            }
            $this->commandeService->ReinitialiserLivraison($idCommande); 
        } catch (Exception $e) {
            GestionnaireErreur::redirigerVersErreurPage($e->getMessage());
        }

    }

    //Supprime une commande
    public function supprimerCommande($idCommande){
        try {
            if (!is_numeric($idCommande) || $idCommande<= 0) {
                throw new Exception("ID de la commande invalide.");
            }
            $this->commandeService->supprimerCommande($idCommande); 
        } catch (Exception $e) {
            GestionnaireErreur::redirigerVersErreurPage($e->getMessage());
        }

    }
}
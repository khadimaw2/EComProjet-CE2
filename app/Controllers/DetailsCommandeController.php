<?php 
namespace App\Controllers;

use Exception;
use App\Services\GestionnaireErreur;
use App\Services\CommandeService;

class DetailsCommandeController {
    private $commandeService;

    public function __construct() {
        $this->commandeService= new CommandeService();
    }

     //Affiche les details de la commande : les produits
    public function afficherDetailsCommande($idCommande){
        try {
            $totalAPayer =0;
            
            $produits = $this->commandeService->recupererProduitsCommande($idCommande); 
            
            include __DIR__ . '/../Views/detailsCommandeView.php';

        } catch (Exception $e) {
            GestionnaireErreur::redirigerVersErreurPage($e->getMessage());
        }
    }
}
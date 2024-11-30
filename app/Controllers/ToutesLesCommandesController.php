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

     //Affiche la vue de la liste 
    public function afficherTouteLesCommandes(){
        try {
            $commandes = $this->commandeService->recupererToutesLesCommandes();

            include __DIR__ . '/../Views/toutesLesCommandesView.php';

        } catch (Exception $e) {
            //GestionnaireErreur::redirigerVersErreurPage($e->getMessage());
            var_dump($commandes);
            echo $e->getMessage();
        }
    }
}
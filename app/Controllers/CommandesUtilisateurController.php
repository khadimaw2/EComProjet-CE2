<?php 
namespace App\Controllers;

use App\Models\Commande;
use Exception;
use App\Services\CommandeService;
use App\Services\GestionnaireErreur;
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

class   CommandesUtilisateurController {
    private $commandeService;

    public function __construct() {
        $this->commandeService = new CommandeService();
    }

     //Affiche la vue de la liste des commandes 
    public function afficherTouteLesCommandes(){
        try {
            $idUtilisateur = $_SESSION['utilisateur']->getId();
            $commandes = $this->commandeService->recupererCommandesUtilisateur($idUtilisateur);

            include __DIR__ . '/../Views/commandesUtilisateurView.php';

        } catch (Exception $e) {
            GestionnaireErreur::redirigerVersErreurPage($e->getMessage());
        }
    }
}
?>
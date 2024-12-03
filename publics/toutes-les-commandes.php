<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Controllers\ToutesLesCommandesController;
use App\Services\GestionnaireErreur;
use App\Services\RedirectionPage;

try {
    // Redirige les utilisateurs non autorisés
    RedirectionPage::redirigerClientStore();


    $toutesLesCommandesController = new ToutesLesCommandesController();


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (empty($_POST['id']) || !is_numeric($_POST['id'])) {
            throw new Exception("ID de la commande invalide.");
        }
        if (empty($_POST['action'])) {
            throw new Exception("Action non spécifiée.");
        }

        $idCommande = intval($_POST['id']);
        $action = $_POST['action'];

        switch ($action) {
            case 'valider-livraison':
                $toutesLesCommandesController->confirmerLivraison($idCommande);
                break;
            case 'reinitialiser-livraison':
                $toutesLesCommandesController->reinitialiserLivraison($idCommande);
                break;
            case 'supprimer':
                $toutesLesCommandesController->supprimerCommande($idCommande);
                break;
            default:
                throw new Exception("Action sur la commande invalide.");
        }
    }

    $toutesLesCommandesController->afficherTouteLesCommandes();

} catch (Exception $e) {
    GestionnaireErreur::redirigerVersErreurPage($e->getMessage());
}
?>

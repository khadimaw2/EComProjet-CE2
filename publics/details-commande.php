<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Controllers\DetailsCommandeController;
use App\Services\GestionnaireErreur;

try {

    if (empty($_GET['id']) || !is_numeric($_GET['id'])) 
    {
        throw new Exception("ID de la commande invalide.");
    }
    else {
        $idCommande = $_GET['id'] ;
        $detailsCommandeController = new DetailsCommandeController();
        $detailsCommandeController->afficherDetailsCommande($idCommande);
    }

} catch (Exception $e) {
    GestionnaireErreur::redirigerVersErreurPage($e->getMessage());
}
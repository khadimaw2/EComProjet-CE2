<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Controllers\CommandesUtilisateurController;
use App\Services\GestionnaireErreur;
use App\Services\RedirectionPage;

try {
    $commandesUtilisateurContoller = new CommandesUtilisateurController();
    $commandesUtilisateurContoller->afficherTouteLesCommandes();

} catch (Exception $e) {
    GestionnaireErreur::redirigerVersErreurPage($e->getMessage());
}
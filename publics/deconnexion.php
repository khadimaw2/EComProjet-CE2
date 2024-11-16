<?php
require_once __DIR__ . '/../vendor/autoload.php';
use App\Controllers\ConnexionController;

session_start();

if (isset($_SESSION['utilisateur'])) {
    $connexionController = new ConnexionController();
    $connexionController->deconnexion();
} 

header("Location: ../publics/connexion.php");
exit();
?>

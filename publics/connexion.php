<?php
    require_once __DIR__ . '/../vendor/autoload.php';
    use App\Controllers\ConnexionController ;

    $connexionController = new ConnexionController() ;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $connexionController->connexion($_POST);
    }else {
        $connexionController->afficherFormulaireConnexion();
    }

?>
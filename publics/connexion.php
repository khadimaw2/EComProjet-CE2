<?php
    require_once __DIR__ . '/../vendor/autoload.php';
    use App\Controllers\ConnexionController ;

    $connexionController = new ConnexionController() ;

    //Rediriger vers la store si l'utilisateur est connecte
    if(isset($_SESSION['utilisateur'])){
        header("Location: store.php");
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['btn-connection'])) {
            $connexionController->connexion($_POST);
        }
        elseif (isset($_POST['btn-mot-de-passe-oublie'])) {
            $connexionController->verifierDemande($_POST);
        }
    }else {
        $connexionController->afficherFormulaireConnexion();
    }


?>
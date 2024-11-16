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
        $connexionController->connexion($_POST);
    }else {
        $connexionController->afficherFormulaireConnexion();
    }


?>
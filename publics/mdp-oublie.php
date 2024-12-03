<?php
    require_once __DIR__ . '/../vendor/autoload.php';
    use App\Controllers\MdpOublieController;

    $mdpOublieController = new MdpOublieController() ;

    //Rediriger vers la store si l'utilisateur est connecte
    if(isset($_SESSION['utilisateur'])){
        header("Location: store.php");
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $mdpOublieController->modiferMdp($_POST);
    }else {
        $mdpOublieController->afficherFormulaireMdpOublie();
    }


?>
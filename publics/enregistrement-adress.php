<?php
    require_once __DIR__ . '/../vendor/autoload.php';

    use App\Controllers\EnregistrementAdressController;

    $enregistrementAdressController= new EnregistrementAdressController(); 

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $enregistrementAdressController->enregistrerAdress($_POST);
    } else {
        $enregistrementAdressController->afficherFormulaireAdress(); // Afficher le formulaire d'inscription
    }
       
?>
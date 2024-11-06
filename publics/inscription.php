<?php
    require_once __DIR__ . '/../vendor/autoload.php';

    use App\Controllers\InscriptionController;

    $inscriptionController = new InscriptionController(); 

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $inscriptionController->inscrire($_POST); // Traiter l'inscription
    } else {
        $inscriptionController->afficherFormulaireInscription(); // Afficher le formulaire d'inscription
    }
?>

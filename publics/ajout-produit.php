<?php 
    require_once __DIR__ . '/../vendor/autoload.php';
    use App\Controllers\AjoutProduitController; 

    $controllerAjoutProduit = new AjoutProduitController();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $controllerAjoutProduit->ajouter($_POST,$_FILES);
    }
    else{
        $controllerAjoutProduit->afficherFormulaireAjoutProduit();
    }
?>
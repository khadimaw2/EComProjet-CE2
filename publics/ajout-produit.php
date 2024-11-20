<?php 
    require_once __DIR__ . '/../vendor/autoload.php';
    use App\Controllers\AjoutProduitController; 
    use App\Models\Produit;

    $controllerAjoutProduit = new AjoutProduitController();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $controllerAjoutProduit->ajouter($_POST,$_FILES);
    }
    else{
        $controllerAjoutProduit->afficherFormulaireAjoutProduit();
    }
?>
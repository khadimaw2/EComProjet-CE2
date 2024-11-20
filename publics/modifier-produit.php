<?php 
    require_once __DIR__ . '/../vendor/autoload.php';
    use App\Controllers\ModifierProduitController;
    use App\Services\GestionnaireErreur;
    use App\Models\Produit;
    use App\Services\ProduitService;

    $modifierProduitController = new modifierProduitController();
    $produitService = new ProduitService();

    try{
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $idProduit = $_GET['id'] ;
            $produitAModifier = $produitService->recupererProduitParId($idProduit);

            ($_SERVER['REQUEST_METHOD'] === 'POST') ? $modifierProduitController->modifier($_POST,$_FILES,$produitAModifier)
            :$modifierProduitController->afficherFormulaireModifierProduit($errors =[], $values = [],$produitAModifier);
        }else{
            throw new Exception("Id du produit non specifie");
        }   
    }catch(Exception $e){
        GestionnaireErreur::redirigerVersErreurPage($e->getMessage());
    }
?>
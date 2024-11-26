<?php 
    require_once __DIR__ . '/../vendor/autoload.php';

use App\Controllers\DetailsProduitController;
use App\Controllers\ModifierProduitController;
    use App\Services\GestionnaireErreur;
    use App\Models\Produit;
    use App\Services\ProduitService;

    $detailsProduitController = new DetailsProduitController();
    $produitService = new ProduitService();

    try{

        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            if (empty($_POST['id']) || !is_numeric($_POST['id']) ||
                !isset($_POST['action']) || $_POST['action']!='ajouter-au-panier') 
            {
                throw new Exception("ID du produit invalide ou action .");
            }
            else {
                $idProduit = $_POST['id'] ;
                $detailsProduitController->ajouterAuPanier($idProduit);
            }
        }

        else {
            if (isset($_GET['id']) && is_numeric($_GET['id'])) {
                $idProduit = $_GET['id'] ;
                $produit = $produitService->recupererProduitParId($idProduit);
                $detailsProduitController->afficherDetailsProduit($produit);
            }
            else{
                throw new Exception("Id du produit non specifie");
            } 
        }
    }catch(Exception $e){
        GestionnaireErreur::redirigerVersErreurPage($e->getMessage());
    }

?>
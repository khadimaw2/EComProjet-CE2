<?php 
   require_once __DIR__ . '/../vendor/autoload.php';
   use App\Controllers\ListeProduitsController;
   use App\Models\Produit;
   use App\Services\GestionnaireErreur;
   use App\Services\RedirectionPage;

   RedirectionPage::redirigerClientStore();

   $listeProduitsController = new ListeProduitsController();
   
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        try {
            if (empty($_POST['id']) || !is_numeric($_POST['id']) || empty($_POST['action']) || $_POST['action'] !== 'supprimer') {
                throw new Exception("ID du produit ou action invalide.");
            }

            $idProduit = intval($_POST['id']);
            $listeProduitsController->supprimerProduit($idProduit);

        }catch (Exception $e) {
            GestionnaireErreur::redirigerVersErreurPage($e->getMessage());
        }
    }

   $listeProduitsController->afficherListeProduits();
?>
<?php 
    require_once __DIR__ . '/../vendor/autoload.php';

    use App\Controllers\PanierController;
    use App\Services\GestionnaireErreur;

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['panier'])) {
        $_SESSION['panier'] = [];
    }

    $panierController = new PanierController();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        try {
            if (empty($_POST['id']) || !is_numeric($_POST['id'])) {
                throw new Exception("ID du produit invalide.");
            }
            $idProduit = intval($_POST['id']);


            if (!in_array($_POST['action'], ['diminuer', 'augmenter', 'supprimer'])) {
                throw new Exception("Action du produit invalide.");
            }

            // Gestion des actions
            switch ($_POST['action']) {
                case 'diminuer':
                    $panierController->modifierQteProduit($idProduit, 'diminuer');
                    break;

                case 'augmenter':
                    $panierController->modifierQteProduit($idProduit, 'augmenter');
                    break;

                case 'supprimer':
                    $panierController->supprimerDuPanier($idProduit);
                    break;
            }
        } catch (Exception $e) {
            // Gestion des erreurs
            error_log($e->getMessage()); // Log de l'erreur
            GestionnaireErreur::redirigerVersErreurPage($e->getMessage());
        }
    }

    // Affichage du panier
    $panierController->afficherContenuPanier();
?>

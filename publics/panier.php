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

    //Verife l'existe ou si le type d'un paramntre numeric est correct
    function verifierParamatreNumeric($nomParametre){
        if (empty($_POST[$nomParametre]) || !is_numeric($_POST[$nomParametre])) {
            throw new Exception(" l'{$nomParametre} est invalide.");
            return 0;
        }
       return intval($_POST[$nomParametre]);
    }

    //Traitement d'une requette post
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        try {
            switch ($_POST['action']) {
                case 'diminuer':
                    $idProduit = verifierParamatreNumeric('id-produit');
                    $panierController->modifierQteProduit($idProduit, 'diminuer');
                    break;

                case 'augmenter':
                    $idProduit = verifierParamatreNumeric('id-produit');
                    $panierController->modifierQteProduit($idProduit, 'augmenter');
                    break;

                case 'supprimer':
                    $idProduit = verifierParamatreNumeric('id-produit');
                    $panierController->supprimerDuPanier($idProduit);
                    break;

                case 'passer-commande':
                    $prixTotal = verifierParamatreNumeric('prix-total');
                    $panierController->passerCommande($_SESSION['utilisateur']->getId(), $prixTotal);
                    break;

                default:
                    throw new Exception("Action du produit invalide.");
                    break;
            }
        } catch (Exception $e) {
            GestionnaireErreur::redirigerVersErreurPage($e->getMessage());
        }
    }

    // Affichage du panier
    $panierController->afficherContenuPanier();
?>

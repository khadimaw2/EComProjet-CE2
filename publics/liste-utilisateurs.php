<?php 
   require_once __DIR__ . '/../vendor/autoload.php';

   use App\Controllers\listeUtilisateursController;
   use App\Models\Utilisateur;
   use App\Services\GestionnaireErreur;

   $listeUtilisateursController = new listeUtilisateursController();
   
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      try {
        if (empty($_POST['id']) || !is_numeric($_POST['id'])) {
            throw new Exception("ID du produit invalide.");
        }else {
            $idUtilisateur = intval($_POST['id']);
            switch ($_POST['action'] ) {        
                case 'supprimer':
                    $listeUtilisateursController->supprimerUtilisateur($idUtilisateur);
                    break;
                case 'modifier-role':
                    empty($_POST['actuelRole'])? throw new Exception("l'actuel role de l'utilisateur non renseigné")
                    :$listeUtilisateursController->modifierRoleUtilisateur($idUtilisateur, $_POST['actuelRole'] );
                    break;
                default:
                    throw new Exception("Action du produit invalide.");
                    break;
            }
          }
    
        } catch (Exception $e) {
          GestionnaireErreur::redirigerVersErreurPage($e->getMessage());
        }
    }

   $listeUtilisateursController->afficherlisteUtilisateurs();
?>
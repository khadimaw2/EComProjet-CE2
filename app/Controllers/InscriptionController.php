<?php 
namespace App\Controllers;

use App\Services\UtilisateurService;
use App\Services\ValidateurDeFormulaire;  
use App\Models\Utilisateur; 
use App\Services\GestionnaireErreur;
use Exception;

class InscriptionController {
    private $utilisateurService;

    public function __construct() {
        $this->utilisateurService = new UtilisateurService();
    }

    // Affiche le formulaire d'inscription avec des erreurs et des valeurs
    public function afficherFormulaireInscription($errors = [], $values = []) {
        include __DIR__ . '/../Views/inscriptionView.php';
    }

    // Inscription de l'utilisateur après validation 
    public function inscrire($donnee) {
        try {
            list($errors, $values) = ValidateurDeFormulaire::validerFormulaireInscription($donnee);
    
            if (empty($errors)) {
                $role = "client";
                $utilisateur = new Utilisateur(
                    $values['nom'],
                    $values['prenom'],
                    $donnee['date_naissance'], 
                    $values['courriel'],
                    password_hash($values['mot_de_passe'], PASSWORD_DEFAULT), 
                    $values['telephone'],
                    $role
                );
    
                $this->utilisateurService->inscrireUtilisateur($utilisateur);
                ValidateurDeFormulaire::unsetSessionVariables(['errors','values']);
                header("Location: ../public/connexion.php");
                exit;
            } 
            else {
                // Stocke erreurs et valeurs pour ré-affichage
                $_SESSION['errors'] = $errors;
                $_SESSION['values'] = $values;
                $this->afficherFormulaireInscription($errors, $values);
            }
        } 
        catch (Exception $e) {
            // Redirige vers la page d'erreur en cas d'exception
            GestionnaireErreur::redirigerVersErreurPage($e->getMessage());
        }
    }
}
?>

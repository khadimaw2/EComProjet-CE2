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

    //Supprime des variables de session
    private function unsetSessionVariables($variables = []){
        foreach ($variables as $variable) {
            unset($_SESSION[$variable]);
        }
    }

    // Valide les données du formulaire d'inscription
    public function validerFormulaireInscription($donnee) {
        $errors = [];
        $values = [];

        // Tableau des champs a valider avec leurs methodes de validation
        $champsAValider = [
            "nom" => "validerNom",
            "prenom" => "validerPrenom",
            "date_naissance" => "validerDateNaissance",
            "courriel" => "validerEmail",
            "mot_de_passe" => "validerMotDePasse",
            "telephone" => "validerTelephone"
        ];

        //Validation des champs en parcourant le tableau precedant
        foreach ($champsAValider as $champs => $validationMethod) {
            $error = ValidateurDeFormulaire::$validationMethod($donnee[$champs]);
            if ($error) {
                $errors[$champs] = $error;
            } else {
                $values[$champs] = htmlspecialchars($donnee[$champs]);
            }
        }

        // Validation de confirmation du mot de passe
        $error = ValidateurDeFormulaire::validerMotDePasseConfirmation($donnee["mot_de_passe"], $donnee["c_mot_de_passe"]);
        if ($error) {
            $errors["c_mot_de_passe"] = $error;
        } else {
            $values["c_mot_de_passe"] = htmlspecialchars($donnee["mot_de_passe"]);
        }

        return [$errors, $values];
    }

    // Inscription de l'utilisateur après validation
    public function inscrire($donnee) {
        try {
            list($errors, $values) = $this->validerFormulaireInscription($donnee);
    
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
                $this->unsetSessionVariables(['errors','values']);
                header("Location: /publics/success.php"); //A modifier
                exit;
            } else {
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

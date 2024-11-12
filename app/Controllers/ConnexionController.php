<?php
namespace App\Controllers ; 

use App\Services\UtilisateurService ; 
use App\Services\ValidateurDeFormulaire ; 

    class ConnexionController{
        private $utilisateurService ; 

        public function __construct(){
            $this->utilisateurService = new UtilisateurService();
        }
        
        //Affiche la vue du formualaire
        public function afficherFormulaireConnexion($errors = [], $values = []){
            include __DIR__.'/../Views/connexionView.php';
        }

        //Verification et validation de la connexion
        public function connexion(array $donneesFormulaire): void {
            // Validation des données du formulaire
            list($errors, $values) = ValidateurDeFormulaire::validerFormulaireConnexion($donneesFormulaire);
        
            if (empty($errors)) {
                $authentificationReussie = $this->utilisateurService->authentificationReussie($values['courriel'], $values['mot_de_passe']);
                
                if (!$authentificationReussie) {
                    $errors['echecAuth'] = "Le mot de passe ou le courriel est incorrect";
                    $this->afficherFormulaireConnexion($errors, []);
                } else {
                    $utilisateur = $this->utilisateurService->recupererInfosUtilisateur($values['courriel']);
                    $_SESSION['utilisateur'] = $utilisateur;
                    ValidateurDeFormulaire::unsetSessionVariables(['errors','values']);
                    header("Location: ../publics/store.php");
                }
            }else {
                // Stocke erreurs et valeurs pour ré-affichage
                $_SESSION['errors'] = $errors;
                $_SESSION['values'] = $values;
                $this->afficherFormulaireConnexion($errors, $values);
            }
        }
    }

?>
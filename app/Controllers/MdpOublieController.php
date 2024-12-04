<?php
namespace App\Controllers ;

use App\Models\Utilisateur;
use App\Services\UtilisateurService ; 
use App\Services\ValidateurDeFormulaire ; 
use App\Services\GestionnaireErreur;
use App\Services\RedirectionPage;
use Exception;
session_start();

    class MdpOublieController{
        private $utilisateurService ; 

        public function __construct(){
            $this->utilisateurService = new UtilisateurService();
        }
        
        //Affiche la vue du formualaire
        public function afficherFormulaireMdpOublie($errors = [], $values = [], $courriel){
            include __DIR__.'/../Views/mdpOublieView.php';
        }

        //Verification et validation de la modiication du mdp
        public function modiferMdp(array $donneesFormulaire): void {
            try {
                // Validation des données du formulaire
                list($errors, $values) = ValidateurDeFormulaire::validerFormulaireMdpOublie($donneesFormulaire);
                $courriel = $donneesFormulaire['courriel'];
                if (empty($errors)) {
                    $nouveauMdp = $donneesFormulaire['mot_de_passe'] ;
                    $this->utilisateurService->majMdp($nouveauMdp,$courriel);
                    ValidateurDeFormulaire::unsetSessionVariables(['errors','values']);
                    RedirectionPage::redirrigersVersPage('connexion.php');
                    exit;
                    
                }else {
                    // Stocke erreurs et valeurs pour ré-affichage
                    $_SESSION['errors'] = $errors;
                    $_SESSION['values'] = $values;

                    $this->afficherFormulaireMdpOublie($errors, $values,$courriel);
                }
            } catch (Exception $e) {
                GestionnaireErreur::redirigerVersErreurPage($e->getMessage());
            }
        }

    }
?>
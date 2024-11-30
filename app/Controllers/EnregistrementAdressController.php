<?php 
namespace App\Controllers;

use App\Models\Adresse;
use App\Services\AdressService;
use App\Services\ValidateurDeFormulaire;  
use App\Models\Utilisateur; 
use App\Services\GestionnaireErreur;
use Exception;
use App\Services\RedirectionPage;

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

class EnregistrementAdressController{
    private $adressService;

    public function __construct() {
        $this->adressService = new AdressService();
    }

    // Affiche le formulaire d'enregistrement de l'adress avec des erreurs et des valeurs
    public function afficherFormulaireAdress($errors = [], $values = []) {
        include __DIR__ . '/../Views/enregistrementAdressView.php';
    }

    //Enregistre l'adress d'un utilisateur apres control reussi des champs du formulaire
    public function enregistrerAdress($donnee){
        try {
            list($errors, $values) = ValidateurDeFormulaire::validerFormulaireAdress($donnee);
    
            if (empty($errors)) {
                $idUtilisateur = $_SESSION['utilisateur']->getId() ;

                $adress =  Adresse::InitialiserAvecTableau($donnee);
                $this->adressService->enregistrerAdressComplet($adress, $_SESSION['utilisateur']->getId());

                $_SESSION['utilisateur']->setAdress($this->adressService->recupererChaineAdressUtilisateur($idUtilisateur));
                
                ValidateurDeFormulaire::unsetSessionVariables(['errors','values']);
                RedirectionPage::redirrigersVersPage('panier.php');
            } 
            else {
                $_SESSION['errors'] = $errors;
                $_SESSION['values'] = $values;
                $this->afficherFormulaireAdress($errors, $values);
            }
        } 
        catch (Exception $e) {
            GestionnaireErreur::redirigerVersErreurPage($e->getMessage());
        }

    }
}
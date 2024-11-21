<?php 
namespace App\Controllers;

use App\Services\UtilisateurServiceService; 
use Exception;
use App\Services\GestionnaireErreur;
use App\Services\UtilisateurService;

class ListeutilisateursController {
    private $utilisateurService;

    public function __construct() {
        $this->utilisateurService = new UtilisateurService();
    }

     //Affiche la vue de la liste 
    public function afficherListeUtilisateurs(){
        try {
            $utilisateurs = $this->utilisateurService->recupererTousLesUtilisateurs();
            if (!empty($utilisateurs)) {
                include __DIR__ . '/../Views/listeUtilisateursView.php';
            } else {
                throw new Exception("La boutique n'a pas d'utilisateur");
            }

        } catch (Exception $e) {
            GestionnaireErreur::redirigerVersErreurPage($e->getMessage());
        }
    }

    //Supprimer un utilisateur de la liste
    public function supprimerUtilisateur($idUtilisateur) {
        try {
            if (!is_numeric($idUtilisateur) || $idUtilisateur <= 0) {
                throw new Exception("ID du utilisateur invalide.");
            }
            $this->utilisateurService->supprimerUtilisateur($idUtilisateur); 
        } catch (Exception $e) {
            GestionnaireErreur::redirigerVersErreurPage($e->getMessage());
        }
    }
    
    //Supprimer un utilisateur de la liste
    public function modifierRoleUtilisateur($idUtilisateur) {
        try {
            if (!is_numeric($idUtilisateur) || $idUtilisateur <= 0) {
                throw new Exception("ID du utilisateur invalide.");
            }
        } catch (Exception $e) {
            GestionnaireErreur::redirigerVersErreurPage($e->getMessage());
        }
    }
}
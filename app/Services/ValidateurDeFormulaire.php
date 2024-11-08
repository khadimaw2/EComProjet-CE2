<?php
namespace App\Services;

use DateTime;
use App\Services\UtilisateurService ;

class ValidateurDeFormulaire {
    // Validation du nom
    public static function validerNom($nom) {
        return empty($nom) ? "Le nom est obligatoire" : null;
    }

    // Validation du prénom
    public static function validerPrenom($prenom) {
        return empty($prenom) ? "Le prénom est obligatoire" : null;
    }

    //Validation de la date de naissance 
    public static function validerDateNaissance($dateNaissance) {
        return empty($dateNaissance) ? "La date est obligatoire" : null;
    }
    
    // Validation de l'email
    public static function validerEmailInscription($email) {
        $utilisateurService = new UtilisateurService();

        return $utilisateurService->recupererCourriel($email) 
            ? "Ce courriel a déjà un compte"
            : self::validerEmail($email);
    }
    
    //Validation de l'email du formulaire de connexion 
    public static function validerEmail($courriel){
        return empty($courriel) ? "Le courriel est obligatoire" : null;
    }

    //Supprime des variables de sessions 
    public static function unsetSessionVariables($variables = []){
        foreach ($variables as $variable) {
            unset($_SESSION[$variable]);
        }
    }
    
    // Validation du mot de passe
    public static function validerMotDePasseConfirmation($mdp, $confirmMdp) {
        if (empty($confirmMdp)) {
            return "La confirmation du mot de passe est obligatoire";
        }
        if ($mdp !== $confirmMdp) {
            return "Les deux mots de passe ne sont pas identiques";
        }
        return null;
    }

    //Validation du mot de passe  
    public static function validerMotDePasse($mdp) {
        return empty($mdp) ? "Le mot de passe est obligatoire" : null;
    }
    
    // Validation du numero de telephone 
    public static function validerTelephone($telephone) {
        return empty($telephone) ? "Le numero de telephone est obligatoire" : null;
    }

    //Validation du role 
    public static function validerRole($role){
        return empty($role) ? "Le role est obligatoire" : null;
    }

    public static function erreurAffichage($input){
        if (!empty($input)): ?>
            <div class="invalid-feedback">
                <?php echo $input; ?>
            </div>
        <?php endif; 
    }
}

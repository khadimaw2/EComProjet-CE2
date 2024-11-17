<?php
namespace App\Services;

use DateTime;
use App\Services\UtilisateurService ;

class ValidateurDeFormulaire {
    //Verifaction de la nullite d'un champs.Retourne un message d'erreur si vide et null sino
    private static function verifierChampsObligatoire($champs, $message){
        return empty($champs) ? $message : null;
    }
    
    // Validation de l'email 
    public static function validerEmailInscription($email) {
        $utilisateurService = new UtilisateurService();
        return $utilisateurService->recupererCourriel($email) 
            ? "Ce courriel a déjà un compte"
            : self::verifierChampsObligatoire($email, "L'email est obligatoire");
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

    //Validation de l' image
    public static function verifierImage($fichierImage) {
        if (empty($fichierImage['name'])) {
            return "L'image est obligatoire";
        } 

        if ($fichierImage['error'] !== UPLOAD_ERR_OK) {
            return "Erreur lors du téléchargement de l'image";
        }
    
        $typeImage = strtolower(pathinfo($fichierImage['name'], PATHINFO_EXTENSION));
        if (!in_array($typeImage, ['jpg', 'jpeg', 'png', 'gif'])) {
            return "Le type du fichier n'est pas recevable";
        }

        return null;
    }

    //Valider de tous les champs du formalaire d'inscription.
    public static function validerFormulaireConnexion($donnee){
        $errors =[];
        $values = [];

        //valider courriel
        $error = self::verifierChampsObligatoire($donnee['courriel'], "Le courriel est obligatoire");
        if ($error) {
            $errors['courriel'] = $error ;
        }else {
            $values['courriel'] = htmlspecialchars($donnee['courriel'])  ;
        }

        //valider mot de passe
        $error = self::verifierChampsObligatoire($donnee['mot_de_passe'], "Le mot de passe est obligatoire");
        if ($error) {
            $errors['mot_de_passe'] = $error ;
        }else {
            $values['mot_de_passe'] = htmlspecialchars($donnee['mot_de_passe'])  ;
        }

        return [$errors, $values ];
    }

    // Valider les données du formulaire d'inscription
    public static function validerFormulaireInscription($donnee) {
        $errors = [];
        $values = [];
    
        // Liste des champs et messages d'erreur associés
        $champsAValider = [
            'nom' => "Le nom est obligatoire",
            'prenom' => "Le prénom est obligatoire",
            'date_naissance' => "La date de naissance est obligatoire",
            'mot_de_passe' => "Le mot de passe est obligatoire",
            'telephone' => "Le téléphone est obligatoire"
        ];
    
        // Validation des champs obligatoires
        foreach ($champsAValider as $champs => $message) {
            $error = self::verifierChampsObligatoire($donnee[$champs], $message);
            if ($error) {
                $errors[$champs] = $error;
            } else {
                $values[$champs] = htmlspecialchars($donnee[$champs]);
            }
        }
    
        // Validation de l'email
        $error = self::validerEmailInscription($donnee['courriel']);
        if ($error) {
            $errors['courriel'] = $error;
        } else {
            $values['courriel'] = htmlspecialchars($donnee['courriel']);
        }
    
        // Validation de la confirmation du mot de passe
        $error = self::validerMotDePasseConfirmation($donnee["mot_de_passe"], $donnee["c_mot_de_passe"]);
        if ($error) {
            $errors["c_mot_de_passe"] = $error;
        } else {
            $values["mot_de_passe"] = htmlspecialchars($donnee["mot_de_passe"]);
        }
    
        return [$errors, $values];
    }

    //Supprime des variables de sessions 
    public static function unsetSessionVariables($variables = []){
        foreach ($variables as $variable) {
            unset($_SESSION[$variable]);
        }
    }    

    //Affichage des erruers d'une erreur a son champs dans le formulaire
    public static function erreurAffichage($input){
        if (!empty($input)): ?>
            <div class="invalid-feedback">
                <?php echo $input; ?>
            </div>
        <?php endif; 
    }

    // Valider les données du formulaire d'ajout de produit
    public static function validerFormulaireAjoutProduit($donnee, $fichiers) {
        $errors = [];
        $values = [];
    
        // Champs obligatoires et leurs messages d'erreur
        $champsAValider = [
            "nom" => "Le nom du produit est obligatoire",
            "prix_unitaire" => "Le prix unitaire est obligatoire",
            "quantite" => "La quantité disponible du produit est obligatoire",
            "courte_description" => "La courte description du produit est obligatoire",
            "description" => "La description du produit est obligatoire",
            "id_categorie" => "La catégorie du produit est obligatoire"
        ];
    
        foreach ($champsAValider as $champs => $message) {
            $error = self::verifierChampsObligatoire($donnee[$champs], $message);
            if ($error) {
                $errors[$champs] = $error;
            } else {
                $values[$champs] = htmlspecialchars($donnee[$champs]);
            }
        }
    
        // Validation de l'image
        $error = self::verifierImage($fichiers['image']);
        if ($error) {
            $errors['image'] = $error;
        } else {
            $values['image'] = htmlspecialchars($fichiers['image']['name']);
        }
    
        return [$errors, $values];
    }
    

}

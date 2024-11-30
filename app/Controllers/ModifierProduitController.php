<?php 
    namespace App\Controllers;

    use App\Models\Produit;
    use App\Services\ProduitService; 
    use App\Services\GestionnaireErreur;
    use App\Services\ValidateurDeFormulaire;
    use App\Services\RedirectionPage;
    use Exception;

    class ModifierProduitController{
        
        private $produitService;

        public function __construct(){
            $this->produitService = new ProduitService() ;
        }

        //Affiche la vue du formulaire 
        public function afficherFormulaireModifierProduit($errors =[], $values = [],Produit $produitAModifier){
            include __DIR__."/../Views/modifierProduitView.php";
        }

        //Modifie les informations d'un produit ainsi que son image 
        public function modifier(array $donnee, array $fichiers, Produit $produitAModifier) {
            try {
                list($errors, $values) = ValidateurDeFormulaire::validerFormulaireModfierProduit($donnee);
        
                if (empty($errors)) {
                    $produit = Produit::InitialiserAvecTableau($donnee);
                    $produit->setId($produitAModifier->getId());
        
                    
                    $image = isset($fichiers['image']) && !$this->imageVide($fichiers) ? $fichiers['image'] : null;
                    $ancienneImage = $image ? $produitAModifier->getCheminImage() : null;
        
                    
                    $modificationsEffectuees = $this->produitService->majProduitComplet($produit, $image, $ancienneImage);
        
                    if (!$modificationsEffectuees) {
                        $errors['modification'] = "Aucune modification n'a été enregistrée.";
                        $this->redirigerVersFormulaireAvecErreur($errors, $values);
                    } else {
                        ValidateurDeFormulaire::unsetSessionVariables(['errors', 'values']);
                        RedirectionPage::redirrigersVersPage('panier.php');
                    }
                } else {
                    
                    $this->redirigerVersFormulaireAvecErreur($errors, $values);
                }
            } catch (Exception $e) {
                GestionnaireErreur::redirigerVersErreurPage($e->getMessage());
            }
        }
        
        
        //Verifie si le champs image du formulaire est vide ou nom
        private function imageVide(array $fichiers): bool {
            $image = $fichiers['image'];
            return empty($image['name']) || !is_uploaded_file($image['tmp_name']);
        }

        //Redirige vers la page de vue du vormulaire evec les variables sesssions contenant les erreurs
        private function redirigerVersFormulaireAvecErreur(array $errors,array $values){
            $_SESSION['errors'] = $errors;
            $_SESSION['values'] = $values;
            $this->afficherFormulaireModifierProduit($errors, $values, Produit::creerObjetVide());
        }
    }


?>
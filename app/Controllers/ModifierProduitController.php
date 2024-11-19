<?php 
    namespace App\Controllers;

    use App\Models\Produit;
    use App\Services\ProduitService; 
    use App\Services\GestionnaireErreur;
    use App\Services\ValidateurDeFormulaire;
    use Exception;

    class ModifierProduitController{
        private $produitService;

        public function __construct(){
            $this->produitService = new ProduitService() ;
        }

        //Affiche la vue du formulaire 
        public function afficherFormulaireModifierProduit($errors =[], $values = [],Produit $produitAModifie){
            include __DIR__."/../Views/modifierProduitView.php";
        }

        //Modifie les informations d'un produit ainsi que son image 
        public function modifier($donnee,$fichiers,$cheminAncienneImage){
            try {
                $image=$fichiers['image'];
                list($errors, $values) = ValidateurDeFormulaire::validerFormulaireAjoutProduit($donnee,$fichiers);
                if (empty($errors)) {
                    $produit = Produit::InitialiserAvecTableau($donnee);
                    $this->produitService->majProduitComplet($produit,$image,$cheminAncienneImage);
                    ValidateurDeFormulaire::unsetSessionVariables(['errors','values']);
                    header("Location: ../publics/store.php");
                    exit;
                }else {
                    $_SESSION['errors'] = $errors;
                    $_SESSION['values'] = $values;
                    $produitAModifie = Produit::creerObjetVide();
                    $this->afficherFormulaireModifierProduit($errors,$values,$produitAModifie);
                }
            } catch (Exception $e) {
                GestionnaireErreur::redirigerVersErreurPage($e->getMessage());
            }
                        
        } 
    }


?>
<?php 
    namespace App\Controllers;

use App\Models\Produit;
use App\Services\ProduitService; 
    use App\Services\GestionnaireErreur;
    use App\Services\ValidateurDeFormulaire;
    use Exception;
    
    class AjoutProduitController{
        private $produitService;

        public function __construct(){
            $this->produitService = new ProduitService() ;
        }

        //Affiche la vue du formulaire 
        public function afficherFormulaireAjoutProduit($errors =[], $values = []){
            include __DIR__."/../Views/ajoutProduitView.php";
        }

        //Controlle et ajout des données d'un produit
        public function ajouter($donnee,$fichiers){
            try {
                $image=$fichiers['image'];
                list($errors, $values) = ValidateurDeFormulaire::validerFormulaireAjoutProduit($donnee,$fichiers);
                if (empty($errors)) {
                    $produit = Produit::InitialiserAvecTableau($donnee);
                    $this->produitService->ajoutCompletProduit($produit,$image);
                    ValidateurDeFormulaire::unsetSessionVariables(['errors','values']);
                    header("Location: ../publics/store.php");
                    exit;
                }
                else {
                    $_SESSION['errors'] = $errors;
                    $_SESSION['values'] = $values;
                    $this->afficherFormulaireAjoutProduit($errors,$values);
                }
            } catch (Exception $e) {
                GestionnaireErreur::redirigerVersErreurPage($e->getMessage());
            }
            
        }       
    }
?>
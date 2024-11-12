<?php 
    namespace App\Controllers;

    use App\Services\ProduitService; 
    use App\Services\GestionnaireErreur;
    use App\Services\ValidateurDeFormulaire;

    class AjoutProduitController{
        private $produitService;

        public function __construct()
        {
            $this->produitService = new ProduitService() ;
        }

        //Affiche la vue du formulaire 
        public function afficherFormulaireAjoutProduit($errors =[], $values = []){
            include __DIR__."/../Views/ajoutProduitView.php";
        }

        public function ajouter($donnee,$fichiers){
            list($errors, $values) = ValidateurDeFormulaire::validerFormulaireAjoutProduit($donnee,$fichiers);
            if (empty($errors)) {
                
            }
            else {
                $_SESSION['errors'] = $errors;
                $_SESSION['values'] = $values;
                $this->afficherFormulaireAjoutProduit($errors,$values);
            }
        }       
    }


?>
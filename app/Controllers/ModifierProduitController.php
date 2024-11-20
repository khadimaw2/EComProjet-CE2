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
        public function afficherFormulaireModifierProduit($errors =[], $values = [],Produit $produitAModifier){
            include __DIR__."/../Views/modifierProduitView.php";
        }

        //Verifie si deux produits passés en parametre sont pareils
        private function produitsPareils(Produit $produit, array $nouvellesDonnees): bool {
            $anciennesDonnees = [
                "nom" => $produit->getNom(),
                "prix_unitaire" => $produit->getPrixUnitaire(),
                "quantite" => $produit->getQuantite(),
                "courte_description" => $produit->getCourteDescription(),
                "description" => $produit->getDescription(),
                "id_categorie" => $produit->getIdCategorie(),
            ];
            unset($nouvellesDonnees['image']);

            return $anciennesDonnees == $nouvellesDonnees;
        }
        
        //Modifie les informations d'un produit ainsi que son image 
        public function modifier(array $donnee, array $fichiers, Produit $produitAModifier) {
            try {
                list($errors, $values) = ValidateurDeFormulaire::validerFormulaireAjoutProduit($donnee, $fichiers);
                
                if ($this->produitsPareils($produitAModifier, $donnee)) {
                    $errors['echecModification'] = "Aucune modification détectée sur le produit.";
                }
        
                if (empty($errors)) {
                    $image = $fichiers['image'];
                    $produit = Produit::InitialiserAvecTableau($donnee);
                    $produit->setId($produitAModifier->getId());
        
                    $this->produitService->majProduitComplet(
                        $produit,
                        $image,
                        $produitAModifier->getCheminImage()
                    );
        
                    ValidateurDeFormulaire::unsetSessionVariables(['errors', 'values']);
                    $this->redirigerVersPage('store.php');
                } else {
                    // Gestion des erreurs
                    $_SESSION['errors'] = $errors;
                    $_SESSION['values'] = $values;
                    $this->afficherFormulaireModifierProduit($errors, $values, Produit::creerObjetVide());
                }
            } catch (Exception $e) {
                GestionnaireErreur::redirigerVersErreurPage($e->getMessage());
            }
        }
        
        // Fonction utilitaire pour la redirection
        private function redirigerVersPage(string $page) {
            header("Location: ../publics/$page");
            exit;
        }
         
    }


?>
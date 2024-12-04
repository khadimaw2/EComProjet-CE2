<?php 
    namespace App\Services;

    use App\Models\Commande;
    use App\Models\Produit;
    use App\Models\Utilisateur;
    use Exception;
    use PDOException;
    use PDO;
    use App\Services\ProduitService;

    class PanierService{

        //Enregistrement les produits d'un dans la table produit_commande
        private function enregistrerProduitPanier(  array $panier, int $idPanier ) {
            try {
                $sql = "INSERT INTO produit_panier(id_produit, id_panier) VALUES (:idProduit, :idPanier )";

                $connexion = Database::recupererConnexion();
                $requette = $connexion->prepare($sql); 

                foreach ($panier as $produit) {
                    $requette->execute([
                        ':idProduit' => $produit->getId(),
                        ':idPanier' => $idPanier
                    ]);
                }
            } catch (PDOException $e) {
                throw new Exception("Erreur lors de l'enegistrement des produits du panier  : " . $e->getMessage());
            }
        }

        //Enregistrement des informations d'un panier et ses produits dans la bd
        public function enregistrerPanier($panier, $idUtilisateur){
            $connexion = Database::recupererConnexion();
            try {
                $connexion->beginTransaction(); 
                $sql = "INSERT INTO panier(id_utilisateur) VALUES (:idUtilisateur)";
                $requette = $connexion->prepare($sql); 
        
                $requette->execute([
                    ':idUtilisateur' =>$idUtilisateur
                ]);
        
                $idPanier = $connexion->lastInsertId();
                $this->enregistrerProduitPanier($panier, $idPanier);
                $connexion->commit(); 
            } catch (PDOException $e) {
                $connexion->rollBack();
                throw new Exception("Erreur lors de l'enregistrement du panier : " . $e->getMessage());
            }
        }



    }
?>
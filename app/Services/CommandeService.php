<?php 
    namespace App\Services;

    use App\Models\Commande;
    use App\Models\Utilisateur;
    use Exception;
    use PDOException;

    class CommandeService{

        //Enregistrement les produits d'une commande dans la table produit_commande
        private function enregistrerProduitCommande(  array $produits, int $idCommande) {
            try {
                $sql = "INSERT INTO produit_commande(id_produit, id_commande, quantite) VALUES (:idProduit, :idCommande, :quantite)";

                $connexion = Database::recupererConnexion();
                $requette = $connexion->prepare($sql); 

                foreach ($produits as $produit) {
                    $requette->execute([
                        ':idProduit' => $produit->getId(),
                        ':idCommande' => $idCommande,
                        ':quantite' => $produit->getQteDansLePanier()
                    ]);
                }
            } catch (PDOException $e) {
                throw new Exception("Erreur lors de l'enegistrement des produits de la commande  : " . $e->getMessage());
            }
        }

        //Enregistrement des informations d'une commande dans la bd
        public function enregistrerCommande(Commande $commande){
            $connexion = Database::recupererConnexion();
            try {
                $connexion->beginTransaction(); 
        
                $sql = "INSERT INTO commande(date_commande, quantite_commande, prix_total, id_utilisateur) 
                        VALUES (:dateCommande, :qteCommande, :prixTotale, :idUtilisateur)";
                $requette = $connexion->prepare($sql); 
        
                $requette->execute([
                    ':dateCommande' => $commande->getDate(),
                    ':qteCommande' =>  $commande->getQuantite(),
                    ':prixTotale' =>  $commande->getPrixTotal(), 
                    ':idUtilisateur' => $commande->getIdUtilisateur(), 
                ]);
        
                $idCommande = $connexion->lastInsertId();
                $this->enregistrerProduitCommande($commande->getProduits(), $idCommande);
        
                $connexion->commit(); 
            } catch (PDOException $e) {
                $connexion->rollBack();
                throw new Exception("Erreur lors de l'enregistrement de la commande : " . $e->getMessage());
            }
        }
        
    }

?>
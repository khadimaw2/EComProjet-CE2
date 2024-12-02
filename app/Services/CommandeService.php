<?php 
    namespace App\Services;

    use App\Models\Commande;
    use App\Models\Produit;
    use App\Models\Utilisateur;
    use Exception;
    use PDOException;
    use PDO;
    use App\Services\ProduitService;

    class CommandeService{

        //Recupere le stock de tous les produits d'un taleau de produit 
        private function recupererStockDesProduits($produits) {
            try {
                $ids = array_values(array_map(fn($produit) => $produit->getId(), $produits));
                $chainePointsInterrogation = implode(',', array_fill(0, count($ids), '?'));
                $sql = "SELECT id_produit, quantite FROM produit WHERE id_produit IN ($chainePointsInterrogation)";

                $connexion = Database::recupererConnexion();
                $requete = $connexion->prepare($sql);
                $requete->execute($ids);
        
                $stocks = [];
                while ($row = $requete->fetch(PDO::FETCH_ASSOC)) {
                    $stocks[$row['id_produit']] = $row['quantite'];
                }
                return $stocks;
            } catch (PDOException $e) {
                throw new Exception("Erreur lors de la récupération des stocks :" . $e->getMessage());
            }
        }
        
        //Verfification de la disponiblite de stock des produits de la commande
        private function verifierStockCommandeProduits(array $produits): array {
            $errors = [];
            try {
                $stocks = $this->recupererStockDesProduits($produits);
                foreach ($produits as $produit) {
                    $idProduit = $produit->getId();
        
                    if (!isset($stocks[$idProduit])) {
                        $errors[$idProduit] = "Le produit avec l'ID $idProduit n'existe pas.";
                    } elseif ($stocks[$idProduit] < $produit->getQteDansLePanier()) {
                        $errors[$idProduit] = "Stock insuffisant pour le produit {$produit->getNom()}. Quantité disponible : {$stocks[$idProduit]}.";
                    }
                }
            } catch (PDOException $e) {
                throw new Exception("Erreur lors de la vérification des stocks : " . $e->getMessage());
            }
            return $errors;
        }

        //Recupere la quantite restant d'un produit 
        private function recupererQteProduitParId(int $idProduit){
            try {
                $sql = "SELECT quantite FROM produit WHERE id_produit = :idProduit";
                $connexion = Database::recupererConnexion();
                $requete = $connexion->prepare($sql);
                $requete->execute([':idProduit'=>$idProduit]);
                return $requete->fetchColumn();
            } catch (Exception $e) {
                throw new Exception("Erreur lors de la quantite du produit:" . $e->getMessage());
            }
        }
        
        //supprimer la produit si la quantite disponible est fini
        private function supprimerProduitSiStockTermine(int $idProduit){
            try {
                $qteRestante = $this->recupererQteProduitParId($idProduit);
                if ($qteRestante==0) {
                    $produitService = new ProduitService();
                    $produitService->supprimerProduit($idProduit);
                }
            } catch (PDOException $e) {
                throw new Exception($e->getMessage());
            }
            

        }

        //Mis a jour de la quantite d'un produit apres validation de la commande
        private function majQuantiteProduit(int $idProduit, int $quantiteAchete): void {
            try {
                $connexion = Database::recupererConnexion();
                $sqlUpdate = "UPDATE produit SET quantite = (quantite - :quantiteAchete) WHERE id_produit = :idProduit";
                $requetteUpdate = $connexion->prepare($sqlUpdate);
                $requetteUpdate->execute([
                    ':quantiteAchete' => $quantiteAchete,
                    ':idProduit' => $idProduit
                ]);

                if ($requetteUpdate->rowCount() === 0) {
                    throw new Exception("La mise à jour de la quantité du produit avec l'ID {$idProduit} a échoué.");
                }
                //$this->supprimerProduitSiStockTermine($idProduit);
            } catch (PDOException $e) {
                throw new Exception("Erreur lors de la mise à jour de la quantité du produit : " . $e->getMessage());
            }
        }
        
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
                    $this->majQuantiteProduit( $produit->getId(), $produit->getQteDansLePanier());
                }
            } catch (PDOException $e) {
                throw new Exception("Erreur lors de l'enegistrement des produits de la commande  : " . $e->getMessage());
            }
        }

        //Enregistrement des informations d'une commande dans la bd
        private function enregistrerCommande(Commande $commande){
            $connexion = Database::recupererConnexion();
            try {
                $connexion->beginTransaction(); 
                $sql = "INSERT INTO commande(date_commande, quantite_commande, prix_total, id_utilisateur, livree) 
                        VALUES (:dateCommande, :qteCommande, :prixTotale, :idUtilisateur,0)";
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

        //Verifie la disponibilité de stock de tous les produits d'un panier. Retourne un tableau d'erreur si il y'en a.
        public function traiterCommande(Commande $commande) {
            try {
                $errors = $this->verifierStockCommandeProduits($commande->getProduits());
        
                if (!empty($errors)) {
                    return $errors;
                }
                $this->enregistrerCommande($commande);
                return [] ;
            } catch (Exception $e) {
                throw new Exception($e->getMessage());
            }
        }
        
        //Recupere les commandes d'un utilisateur donné
        public function recupererCommandesUtilisateur($idUtilisateur){
            try {
                $connexion = Database::recupererConnexion();
                $connexion->beginTransaction(); 
        
                $sql = "SELECT * FROM commande WHERE id_utilisateur = :idUtilisateur";

                $requette = $connexion->prepare($sql); 
                $requette->execute([
                    ':idUtilisateur' => $idUtilisateur
                ]) ;

                $donneesCommande = $requette->fetchAll(PDO::FETCH_ASSOC);
                $commandes = array_map(fn($donnee) => Commande::InitialiserAvecTableau($donnee), $donneesCommande);
                return $commandes;

            } catch (PDOException $e) {
                $connexion->rollBack();
                throw new Exception("Erreur lors de la recuperation des commandes : " . $e->getMessage());
            }
        }

        //Recupere toutes les commandes du syteme
        public function recupererToutesLesCommandes() {
            try {
                $connexion = Database::recupererConnexion();
        
                $sql = "SELECT * FROM commande";
                $requette = $connexion->prepare($sql);
                $requette->execute();
        
                $donneesCommande = $requette->fetchAll(PDO::FETCH_ASSOC);
                return array_map(fn($donnee) => Commande::InitialiserAvecTableau($donnee), $donneesCommande);
        
            } catch (PDOException $e) {
                throw new Exception("Erreur lors de la récupération des commandes : " . $e->getMessage());
            }
        }
        

        //Met a jour la a colonne livree de la commande a 1
        public function confirmerLivraison($idCommande){
            try {
                $connexion = Database::recupererConnexion();
                $sql = "UPDATE commande SET livree = 1 WHERE id_commande = :idCommande";

                $requette = $connexion->prepare($sql); 
                $requette->execute([
                    ':idCommande' =>$idCommande 
                ]) ;
                if ($requette->rowCount() === 0) {
                    throw new Exception("ID ou action sur la commande invalide");
                }
            } catch (PDOException $e) {
                throw new Exception("Erreur lors de la confirmation des commandes : " . $e->getMessage());
            }

        }

        //Met a jour la a colonne livree de la commande a , a refactoriser avec la fonction precedente plustardd
        public function reinitialiserLivraison($idCommande){
            try {
                $connexion = Database::recupererConnexion();
        
                $sql = "UPDATE commande SET livree = 0 WHERE id_commande = :idCommande";

                $requette = $connexion->prepare($sql); 
                $requette->execute([
                    ':idCommande' =>$idCommande 
                ]) ;
                if ($requette->rowCount() === 0) {
                    throw new Exception("ID ou action sur la commande invalide");
                }
            } catch (PDOException $e) {
                throw new Exception("Erreur lors de la confirmation des commandes : " . $e->getMessage());
            }

        }


        //Recuperer tous les produits dans une commande
        public function recupererProduitsCommande($idCommande){
            try {
                $connexion = Database::recupererConnexion();
                $connexion->beginTransaction(); 
        
                $sql = "SELECT p.id_produit AS id, p.nom AS nom, p.prix_unitaire AS prix_unitaire, 
                           p.description AS description, p.courte_description AS courte_description, 
                           p.quantite AS quantite, p.id_categorie AS id_categorie, 
                           c.nom_categorie AS nom_categorie, i.chemin AS chemin_image
                        FROM categorie c 
                        JOIN produit p ON p.id_categorie = c.id_categorie
                        LEFT JOIN image i ON p.id_produit = i.id_produit
                        WHERE id_commande= :idCommande";

                $requette = $connexion->prepare($sql); 
                $requette->execute([
                    ':idCommande' =>$idCommande 
                ]) ;

                $donneesProduit = $requette->fetchAll(PDO::FETCH_ASSOC);
                $produits = array_map(fn($donnee) => Produit::InitialiserAvecTableau($donnee),$donneesProduit);
                return $produits;

            } catch (PDOException $e) {
                throw new Exception("Erreur lors de la recuperation des commandes : " . $e->getMessage());
            }
        }

        //Aide la vue a afficher les commandes en evitant les repertion
        public static function afficherCommandes($commandes, $utilisateurService, $adressService, $statut,$tout) {
            $i = 1;
            foreach ($commandes as $commande){
               if ($tout) {
                    $utilisateur = $utilisateurService->recupererInfosUtilisateurParId($commande->getIdUtilisateur());
                    $adressClient = $adressService->recupererChaineAdressUtilisateur($commande->getIdUtilisateur());
                    include __DIR__ . '/../Views/commandeTbodyTr.php';
               }
               else{
                    if ($commande->getStatut() == $statut) {
                        $utilisateur = $utilisateurService->recupererInfosUtilisateurParId($commande->getIdUtilisateur());
                        $adressClient = $adressService->recupererChaineAdressUtilisateur($commande->getIdUtilisateur());
                        include __DIR__ . '/../Views/commandeTbodyTr.php';
                    }
               }
            }
        }

         //Supprime une commande de la Bd
        public function supprimerCommande($idCommande){
            try {
                $connexion = Database::recupererConnexion();    
                $sql = "DELETE FROM commande WHERE id_commande = :idCommande";

                $requette = $connexion->prepare($sql); 
                $requette->execute([
                    ':idCommande' =>$idCommande 
                ]);
            } catch (PDOException $e) {
                throw new Exception("Erreur lors de la recuperation des commandes : " . $e->getMessage());
            }
        }
        
        
    }

?>
<?php
namespace App\Services;

require_once __DIR__ . '/../../config/config.php';

use App\Models\Produit;
use Exception;
use PDO;
use PDOException;

class ProduitService {

    // Enregistre les informations d'une image dans la table image de la BD
    private function enregistrerImageInfo($cheminImage, $idProduit) {
        try {
            $sql = "INSERT INTO image(chemin, id_produit) VALUES (:chemin, :idProduit)";
            $connexion = Database::recupererConnexion();
            $requete = $connexion->prepare($sql);
            $requete->execute([
                ':chemin' => $cheminImage,
                ':idProduit' => $idProduit
            ]);
        } catch (PDOException $e) {
            throw new Exception("Erreur PDO lors de l'enregistrement des informations de l'image : " . $e->getMessage());
        }
    }

    // Télécharge l'image dans le dossier images-produit et retourne son chemin relatif
    private function telechargerImage($image) : string {
        try {
            $imageName = uniqid() . '_' . basename($image['name']);
            $cheminRelatifImage = "images-produit/" . $imageName;
            $imageDestination = '../ressources/' . $cheminRelatifImage;

            if (move_uploaded_file($image['tmp_name'], $imageDestination)) {
                return $cheminRelatifImage;
            } else {
                throw new Exception("Erreur lors du téléchargement de l'image.");
            }
        } catch (Exception $e) {
            throw new Exception("Erreur lors du téléchargement de l'image : " . $e->getMessage());
        }
    }

    // Enregistre les informations du produit dans la table produit de la BD
    private function enregistrerProduitInfo(Produit $produit) {
        try {
            $sql = "INSERT INTO Produit(nom, quantite, courte_description, description, prix_unitaire, id_categorie) 
                    VALUES (:nom, :quantite, :courte_description, :description, :prix_unitaire, :id_categorie)";
            $connexion = Database::recupererConnexion();
            $requete = $connexion->prepare($sql);
            $requete->execute([
                ':nom' => $produit->getNom(),
                ':quantite' => $produit->getQuantite(),
                ':courte_description' => $produit->getCourteDescription(),
                ':description' => $produit->getDescription(),
                ':prix_unitaire' => $produit->getPrixUnitaire(),
                ':id_categorie' => $produit->getIdCategorie(),
            ]);
            return $connexion->lastInsertId();
        } catch (PDOException $e) {
            throw new Exception("Erreur PDO lors de l'enregistrement des informations du produit : " . $e->getMessage());
        }
    }

    // Télécharge et enregistre respectivement l'image et les informations d'un produit et de son image dans la BD
    public function ajoutCompletProduit(Produit $produit, $image) : void {
        $connexion = Database::recupererConnexion();
        try {
            $connexion->beginTransaction();
            $idProduit = $this->enregistrerProduitInfo($produit);
            $cheminImage = $this->telechargerImage($image);
            $this->enregistrerImageInfo($cheminImage, $idProduit);
            $connexion->commit();
        } catch (Exception $e) {
            $connexion->rollBack();
            throw new Exception("Erreur lors de l'ajout complet du produit : " . $e->getMessage());
        }
    }
     
    // Met à jour les informations d'un produit, retourne null si rien n'a ete modifie sur le produit
    private function majProduitInfo(Produit $produit) {
        try {
            $sql = "UPDATE produit 
                    SET nom = :nom, prix_unitaire = :prix_unitaire, quantite = :quantite, courte_description = :courte_description, description = :description, id_categorie = :id_categorie  
                    WHERE id_produit = :id_produit";
            $connexion = Database::recupererConnexion();
            $requete = $connexion->prepare($sql);
            $requete->execute([
                ':nom' => $produit->getNom(),
                ':prix_unitaire' => $produit->getPrixUnitaire(),
                ':quantite' => $produit->getQuantite(),
                ':courte_description' => $produit->getCourteDescription(),
                ':description' => $produit->getDescription(),
                ':id_categorie' => $produit->getIdCategorie(),
                ':id_produit' => $produit->getId(),
            ]);
            return $requete->rowCount() > 0;
        } catch (PDOException $e) {
            throw new Exception("Erreur PDO lors de la mise à jour des informations du produit : " . $e->getMessage());
        }
    }

    //Met a jour les informations l'image d'un produit dans la bd
    private function majImageInfo($cheminImage,$idProduit) : void{
        try {
            $sql = "UPDATE image SET chemin = :chemin WHERE id_produit = :id_produit";
            $connexion = Database::recupererConnexion();
            $requete = $connexion->prepare($sql);
            $requete->execute([
                ':chemin' =>$cheminImage,
                ':id_produit' => $idProduit
            ]);
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de l'enregistrement des informations de l'image dans la bd ".$e->getMessage());
        } 
    }

    // Supprime le fichier de l'image
    private function supprimerImageFichier($cheminAncienneImage) : void {
        try {
            $cheminComplet = "../ressources/" . $cheminAncienneImage;
            if (file_exists($cheminComplet) && !unlink($cheminComplet)) {
                throw new Exception("Erreur lors de la suppression de l'ancienne image.");
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    //Modification complete d'un produit
    public function majProduitComplet(Produit $produit, $image=null, $cheminAncienneImage=null) :bool {
        try {
            $connexion = Database::recupererConnexion();
            $connexion->beginTransaction(); 

            $infoProduitModifiees = $this->majProduitInfo($produit);

            $imageModifiee = false;
            if ($image !== null && $cheminAncienneImage !== null) {
                $cheminImage = $this->telechargerImage($image);
                $this->majImageInfo($cheminImage, $produit->getId());
                $this->supprimerImageFichier($cheminAncienneImage);
                $imageModifiee = true;
            }

            $connexion->commit();

            return $infoProduitModifiees || $imageModifiee;
            
        }catch (PDOException $e) {
            $connexion->rollBack();
            throw new Exception("Erreur liée à la base de données : " . $e->getMessage());
        }catch (Exception $e) {
            $connexion->rollBack();
            throw new Exception("Erreur lors de la mise à jour complète : " . $e->getMessage());
        }
    }

    //Recupere tous les produits et retourne un tableau d'objet de type Produit
    public function recupererTousLesProduits(): array {
        try {
            $sql = "SELECT p.id_produit AS id, p.nom AS nom, p.prix_unitaire AS prix_unitaire, 
                           p.description AS description, p.courte_description AS courte_description, 
                           p.quantite AS quantite, p.id_categorie AS id_categorie, 
                           c.nom_categorie AS nom_categorie, i.chemin AS chemin_image
                    FROM categorie c 
                    JOIN produit p ON p.id_categorie = c.id_categorie
                    LEFT JOIN image i ON p.id_produit = i.id_produit";
    
            $connexion = Database::recupererConnexion();
            $requete = $connexion->prepare($sql);
            $requete->execute();
    
            $produitsDonnee = $requete->fetchAll(PDO::FETCH_ASSOC);
    
            // Transformer chaque tableau associatif en instance de Produit
            $produits = array_map(fn($donnee) => Produit::InitialiserAvecTableau($donnee), $produitsDonnee);
    
            return $produits;
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la récupération des produits : " . $e->getMessage());
        }
    }

    // Récupère un produit à travers son ID
    public function recupererProduitParId($idProduit) {
        try {
            $sql = "SELECT 
                        p.id_produit AS id, 
                        p.nom AS nom, 
                        p.prix_unitaire AS prix_unitaire, 
                        p.description AS description, 
                        p.courte_description AS courte_description, 
                        p.quantite AS quantite, 
                        p.id_categorie AS id_categorie, 
                        c.nom_categorie AS nom_categorie, 
                        i.chemin AS chemin_image
                    FROM categorie c 
                    JOIN produit p ON p.id_categorie = c.id_categorie
                    LEFT JOIN image i ON p.id_produit = i.id_produit
                    WHERE p.id_produit = :idProduit";
            $connexion = Database::recupererConnexion();
            $requete = $connexion->prepare($sql);
            $requete->execute([':idProduit' => $idProduit]);
            $produit = $requete->fetch(PDO::FETCH_ASSOC);

            if (!$produit) {
                throw new Exception("Aucun produit trouvé avec l'ID : $idProduit");
            }

            return Produit::InitialiserAvecTableau($produit);
        } catch (PDOException $e) {
            throw new Exception("Erreur PDO lors de la récupération du produit : " . $e->getMessage());
        }
    }

    // Récupérer le chemin de l'image associée à un produit
    private function recupererCheminImage(int $idProduit): ?string {
        try {
            $sql = "SELECT chemin FROM image WHERE id_produit = :id_produit";
            $connexion = Database::recupererConnexion();
            $requete = $connexion->prepare($sql);
            $requete->execute([':id_produit' => $idProduit]);

            $chemin = $requete->fetchColumn();

            return $chemin !== false ? $chemin : null;
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la récupération du chemin de l'image : " . $e->getMessage());
        }
    }

    // Supprime un produit à travers son ID
    public function supprimerProduit(int $idProduit): void {
        try {
            $cheminImage = $this->recupererCheminImage($idProduit);
            
            $cheminImage? $this->supprimerImageFichier($cheminImage) 
            :throw new Exception("Erreur a la suppression de l'image du produit");

            $sql = "DELETE FROM Produit WHERE id_produit = :id_produit";
            $connexion = Database::recupererConnexion();
            $requete = $connexion->prepare($sql);
            $requete->execute([':id_produit' => $idProduit]);

            if ($requete->rowCount() === 0) {
                throw new Exception("Aucun produit trouvé avec l'ID fourni.");
            }
        }catch (Exception $e) {
            throw new Exception("Erreur lors de la suppression du produit : " . $e->getMessage());
        }
    }
}
?>

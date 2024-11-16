<?php
namespace App\Services;

require_once __DIR__ . '/../../config/config.php';
use Exception;
use PDO;

class ProduitService {

    // Enregistrer les informations d'une image dans la table image de la BD
    private function enregistrerImageInfo($imageInfo) {
        try {
            $sql = "INSERT INTO image(chemin, id_produit) VALUES (:chemin, :idProduit)";
            $connexion = Database::recupererConnexion();
            $requete = $connexion->prepare($sql);
            $requete->execute([
                ':chemin' => $imageInfo['chemin'],
                ':idProduit' => $imageInfo['idProduit']
            ]);
        } catch (Exception $e) {
            throw new Exception("Erreur lors de l'enregistrement des informations de l'image : " . $e->getMessage());
        }
    }

    // Télécharger l'image dans le dossier images-produit du projet et enregistrer les infos dans la BD
    private function telechargerEtEnregistrerImageInfo($image, $idProduit) {
        try {
            $imageName = basename($image['name']);
            $cheminRelatifImage = "images-produit/".$imageName;
            $imageDestination = REPERTOIRE_RESSOURCE.$cheminRelatifImage;
           
            $src = $image['tmp_name'];
            
            if (move_uploaded_file($src, $imageDestination)) {
                $imageInfo = [
                    'chemin' => $cheminRelatifImage,
                    'idProduit' => $idProduit
                ];
                $this->enregistrerImageInfo($imageInfo);
            } else {
                throw new Exception("Erreur lors du téléchargement de l'image");
            }
        } catch (Exception $e) {
            throw new Exception("Erreur lors du téléchargement et de l'enregistrement de l'image : " . $e->getMessage());
        }
    }

    // Enregistrer les informations du produit dans la table produit de la BD
    private function enregistrerProduitInfo($infoProduit) {
        try {
            $sql = "INSERT INTO Produit(nom, quantite, courte_description, description, prix_unitaire, id_categorie) 
                    VALUES (:nom, :quantite, :courte_description, :description, :prix_unitaire, :id_categorie)";
            $connexion = Database::recupererConnexion();
            $requete = $connexion->prepare($sql);
            $requete->execute([
                ':nom' => $infoProduit['nom'],
                ':quantite' => $infoProduit['quantite'],
                ':courte_description' => $infoProduit['courte_description'],
                ':description' => $infoProduit['description'],
                ':prix_unitaire' => $infoProduit['prix_unitaire'],
                ':id_categorie' => $infoProduit['categorie'],
            ]);
            return $connexion->lastInsertId();
        } catch (Exception $e) {
            throw new Exception("Erreur lors de l'enregistrement des informations du produit : " . $e->getMessage());
        }
    }

    // Télécharger et enregistrer respectivement l'image et les informations d'un produit et de son image dans la BD
    public function ajoutCompletProduit($infoProduit, $image) {
        try {
            $connexion = Database::recupererConnexion();
            $connexion->beginTransaction(); 
            $idProduit = $this->enregistrerProduitInfo($infoProduit);
            $this->telechargerEtEnregistrerImageInfo($image, $idProduit); 
            $connexion->commit();
        } catch (Exception $e) {
            $connexion->rollBack(); 
            throw new Exception("Erreur lors de l'ajout complet du produit : " . $e->getMessage());
        }
    }

    //Recuperer tous les produits de la base de donnée
    public function recupererTousLesProduits(){
        try {
            $sql = "SELECT p.*, i.chemin AS image_chemin, c.nom_categorie 
                    FROM categorie c 
                    JOIN produit p ON c.id_categorie = p.id_categorie  
                    LEFT JOIN image i ON p.id_produit = i.id_produit";

            $connexion = Database::recupererConnexion();
            $requete = $connexion->prepare($sql);
            $requete->execute();
            $produits = $requete->fetchAll(PDO::FETCH_ASSOC);
            return $produits;

        } catch (Exception $e) {
            throw new Exception ("Erreur lors de la récupération des produits : " . $e->getMessage());
        }
    }   
}
?>

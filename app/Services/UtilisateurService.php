<?php 
namespace App\Services;

use App\Models\Utilisateur;
use Exception;
use PDO;

class UtilisateurService {

    //Recuperer l'id d'un role a partir de sa description
    private function recupererRoleId($roleDescription): ?int {
        try {
            $sql = "SELECT id_role FROM role WHERE description = :description";
            $connexion = Database::recupererConnexion();
            $requette = $connexion->prepare($sql);
            $requette->execute([':description' => $roleDescription]);

            $idRole = $requette->fetchColumn();
            return $idRole !== false ? (int) $idRole : null;
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la récupération du rôle : " . $e->getMessage());
        }
    }
    
    //Enregistrement de sa correspondance(idRole, idUtilisateur) dans la table role utilisateur 
    private function enregistrerRole(int $idUtilisateur, int $idRole): void {
        try {
            $sql = "INSERT INTO role_utilisateur (id_role, id_utilisateur) VALUES (:id_role, :id_utilisateur)";
            $connexion = Database::recupererConnexion();
            $requette = $connexion->prepare($sql);
            $requette->execute([
                ':id_role' => $idRole,
                ':id_utilisateur' => $idUtilisateur
            ]);
        } catch (Exception $e) {
            throw new Exception("Erreur lors de l'enregistrement du rôle utilisateur : " . $e->getMessage());
        }
    }
    
    //Inscrire l'utilisateur 
    public function inscrireUtilisateur(Utilisateur $utilisateur): ?int {
        try {
            $sql = "INSERT INTO Utilisateur (nom, prenom, date_naissance, courriel, mot_de_passe, telephone) 
                    VALUES (:nom, :prenom, :dateNaissance, :courriel, :motDePasse, :telephone)";
            $connexion = Database::recupererConnexion(); 
            $requette = $connexion->prepare($sql);
            $requette->execute([
                ':nom' => $utilisateur->getNom(),
                ':prenom' => $utilisateur->getPrenom(),
                ':dateNaissance' => $utilisateur->getDateNaissance(),
                ':courriel' => $utilisateur->getCourriel(),
                ':motDePasse' => password_hash($utilisateur->getMotDePasse(), PASSWORD_DEFAULT),
                ':telephone' => $utilisateur->getTelephone()
            ]);

            $idUtilisateur = $connexion->lastInsertId();
            $idRole = $this->recupererRoleId($utilisateur->getRole());

            if ($idRole !== null) {
                $this->enregistrerRole((int)$idUtilisateur, $idRole);
            } else {
                throw new Exception("Rôle non reconnu");
            }

            return (int)$idUtilisateur;
        } catch (Exception $e) {
            throw new Exception("Erreur lors de l'inscription de l'utilisateur : " . $e->getMessage());
        }
    }

    //Recupere un courriel dans la table utilisateur, retourne le courriel si trouvé, sinon retourne false
    public function recupererCourriel(string $courriel): ?string {
        try {
            $sql = "SELECT courriel FROM Utilisateur WHERE courriel = :courriel";
            $connexion = Database::recupererConnexion();
            $requette = $connexion->prepare($sql);
            $requette->execute([':courriel' => $courriel]);
            return $requette->fetchColumn() ;
        } 
        catch (Exception $e) {
            throw new Exception("Erreur lors de la vérification de l'existence du courriel : " . $e->getMessage());
        }
    }

    //Recupere le mot de passe d'un courriel donné. (Toujours confirmer l'existence courriel en parametre)
    private function recupererMotDePasse($courrielUtilisateur) : string{
        try {
            $connexion = Database::recupererConnexion();
            $sql = "SELECT mot_de_passe FROM Utilisateur WHERE courriel = :courriel";
            $requette = $connexion->prepare($sql);
            $requette->execute([':courriel'=>$courrielUtilisateur]) ; 
            $motDePasseTrouve = $requette->fetchColumn();
            if (!$motDePasseTrouve) {
                throw new Exception("Aucun resultat trouvé");
            }
            return $motDePasseTrouve;
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la recuperation du mot de passe de l'utilisateur ".$e->getMessage());
        }
        
    }

    //Authentification utilisateur
    public function authentificationReussie($courrielfourni, $motDePassefourni) : bool {
        try {
            $courrielConfirme = $this->recupererCourriel($courrielfourni);

            if ($courrielConfirme) {
                $motDePasseHash = $this->recupererMotDePasse($courrielConfirme);               
                return password_verify($motDePassefourni, $motDePasseHash);
            } else {
                return false;
            }
        } catch (Exception $e) {
            throw new Exception("Erreur lors de l'authentification de l'utilisateur : " . $e->getMessage());
        }
    }

    //Recuperer les informations d'un utilisateur(Confirmé) a partir de son courriel
    public function recupererInfosUtilisateur(string $courriel): array {
        try {
            $sql = "SELECT * FROM Utilisateur WHERE courriel = :courriel";
            $connexion = Database::recupererConnexion();
            $requette = $connexion->prepare($sql);
            $requette->execute([':courriel' => $courriel]);
            
            $resultat = $requette->fetch(PDO::FETCH_ASSOC);
    
            if (!$resultat) {
                throw new Exception("Ce courriel n'existe pas dans la base de données.");
            }
    
            return $resultat;
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la récupération des informations de l'utilisateur : " . $e->getMessage());
        }
    }
    
}

?>

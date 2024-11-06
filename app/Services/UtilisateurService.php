<?php 
namespace App\Services;

use App\Models\Utilisateur;
use Exception;
use PDO;

class UtilisateurService {

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

    public function courrielExistant(string $courriel): bool {
        try {
            $sql = "SELECT 1 FROM Utilisateur WHERE courriel = :courriel";
            $connexion = Database::recupererConnexion();
            $requette = $connexion->prepare($sql);
            $requette->execute([':courriel' => $courriel]);
            return $requette->fetchColumn() !== false;
        } 
        catch (Exception $e) {
            throw new Exception("Erreur lors de la vérification de l'existence du courriel : " . $e->getMessage());
        }
    }
}

?>

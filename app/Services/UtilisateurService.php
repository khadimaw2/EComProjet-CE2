<?php 
namespace App\Services;

use App\Models\Utilisateur;
use Exception;
use PDO;
use PDOException;

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
        }
         catch (PDOException $e) {
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
        } catch (PDOException $e) {
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
        }
        catch (PDOException $e) {
            throw new Exception("Erreur liée a la bd lors de l'inscription de l'utilisateur : " . $e->getMessage());
        }
        catch (Exception $e) {
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
        catch (PDOException $e) {
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
        }catch (PDOException $e) {
            throw new Exception("Erreur lors de la recuperation du mot de passe de l'utilisateur ".$e->getMessage());
        }
        catch (Exception $e) {
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
            }
            return false;
            
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de l'authentification de l'utilisateur : " . $e->getMessage());
        }
    }

    //Recupere toutes  les informations d'un utilisateur via son courriel.
    public function recupererInfosUtilisateur(string $courriel): Utilisateur {
        try {
            $sql = "SELECT u.*, r.description 
                    FROM Utilisateur u
                    JOIN Role_utilisateur ru ON u.id_utilisateur = ru.id_utilisateur
                    JOIN Role r ON ru.id_role = r.id_role
                    WHERE courriel = :courriel";
            $connexion = Database::recupererConnexion();
            $requette = $connexion->prepare($sql);
            $requette->execute([':courriel' => $courriel]);
    
            $utilisateur = $requette->fetch(PDO::FETCH_ASSOC);
            if (!$utilisateur) {
                throw new Exception("Ce courriel n'existe pas dans la base de données.");
            }
            return $this->transformerEnInstanceUtilisateur($utilisateur);

        }catch(PDOException $e) {
            throw new Exception("Erreur lors de la récupération des informations de l'utilisateur : " . $e->getMessage());
        }
        catch (Exception $e) {
            throw new Exception("Erreur lors de la récupération des informations de l'utilisateur : " . $e->getMessage());
        }
    }

    // Transformer chaque tableau associatif (d'un grand tableau) en instance de Utilisateur
    private function transformerEnTabObjUtilisateur( array $utilisateursDonnee) : array{
        $utilisateurs = array_map(
            function ($donnee) {
                unset($donnee['mot_de_passe']);
                return $this->transformerEnInstanceUtilisateur($donnee);
            },
            $utilisateursDonnee
        );
        return $utilisateurs ;
    }

    //Transformer un tableau en une instance utilisateur
    private function transformerEnInstanceUtilisateur(array $utilisateur) : Utilisateur {
        $adressService = new AdressService();
        $utilisateur['adresse'] = $adressService->recupererChaineAdressUtilisateur($utilisateur['id_utilisateur']);
        return Utilisateur::InitialiserAvecTableau($utilisateur);
    }
    
    //Recupere tous les utilisateurs 
    public function recupererTousLesUtilisateurs(): array {
        try {
            $sql = "SELECT u.*, r.description 
                    FROM Utilisateur u
                    JOIN Role_utilisateur ru ON u.id_utilisateur = ru.id_utilisateur
                    JOIN Role r ON ru.id_role = r.id_role";

            $connexion = Database::recupererConnexion();
            $requette = $connexion->prepare($sql);
            $requette->execute();

            $utilisateurs = $this->transformerEnTabObjUtilisateur($requette->fetchAll(PDO::FETCH_ASSOC));

            return $utilisateurs;
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la récupération des utilisateurs : " . $e->getMessage());
        }
    }

    //Recuperer un utilisateur via son id
    public function recupererInfosUtilisateurParId($idUtilisateur){
        try {
            $sql = "SELECT u.*, r.description 
                    FROM Utilisateur u
                    JOIN Role_utilisateur ru ON u.id_utilisateur = ru.id_utilisateur
                    JOIN Role r ON ru.id_role = r.id_role
                    WHERE id_utilisateur = :idUtilisateur";
            $connexion = Database::recupererConnexion();
            $requette = $connexion->prepare($sql);
            $requette->execute([':idUtilisateur' => $idUtilisateur]);
    
            $utilisateur = $requette->fetch(PDO::FETCH_ASSOC);
            if (!$utilisateur) {
                throw new Exception("Impossible de trouvé un utilisateur avec cet id.");
            }
            unset($utilisateur['mot_de_passe']);
            return $this->transformerEnInstanceUtilisateur($utilisateur);

        }catch(PDOException $e) {
            throw new Exception("Erreur lors de la récupération des informations de l'utilisateur : " . $e->getMessage());
        }
        catch (Exception $e) {
            throw new Exception("Erreur lors de la récupération des informations de l'utilisateur : " . $e->getMessage());
        }

    }

    //Supprimer un utilisateur via son id
    public function supprimerUtilisateur($idUtilisateur) : void{
        try {
            $sql = "DELETE FROM utilisateur WHERE id_utilisateur = :id_utilisateur";
            $connexion = Database::recupererConnexion();
            $requete = $connexion->prepare($sql);
            $requete->execute([':id_utilisateur' => $idUtilisateur]);

            if ($requete->rowCount() === 0) {
                throw new Exception("Aucun utilisateur trouvé avec l'ID fourni.");
            }
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la suppression de l'utilisateur : " . $e->getMessage());
        }    
    }

    //Changer le role d'un utilisateur
    public function changerRoleUtilisateur($idUtilisateur, $actuelRole) : void{
        try {
            $sql = "UPDATE role_utilisateur SET id_role = :idNouveauRole WHERE id_utilisateur = :idUtilisateur";

            $connexion = Database::recupererConnexion();

            $requete = $connexion->prepare($sql);
            $idNouveauRole = $actuelRole== 'client' ? 3 : 1; 
            $requete->execute([
                ':idUtilisateur' => $idUtilisateur,
                ':idNouveauRole' => $idNouveauRole
            ]);

            $requete->rowCount() > 0 ?? throw new Exception("Id ou role de l'utilisateur invalide") ;       
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la modification du role (de admin a Client)".$e);   
        }
    }

    //Deconnexion d'un utilisateur 
    public function deconnexion(){
        if(isset($_SESSION['utilisateur'])){
            unset($_SESSION['utilisateur']);
            header("Location: ../publics/connexion.php");
        }
    }
}

?>

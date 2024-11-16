<?php 
    namespace App\Services;

    use App\Models\Adresse;
    use App\Models\Utilisateur;
    use Exception;
    use PDO;

    class AdressService{

        //Enregesitrement d'une adresse dans la table adress et link l'adress et l'utilisateur dans la table adresse utilisateur
        public function enregistrerAdressComplet(Adresse $adress, int $id_utilisateur): void {
            try {
                $sql = "INSERT INTO adresse (rue, ville, code_postal, pays, numero, province) 
                        VALUES (:rue, :ville, :code_postal, :pays, :numero, :province)";
        
                $connexion = Database::recupererConnexion();
                $connexion->beginTransaction(); 

                $requette = $connexion->prepare($sql);
                $requette->execute([
                    ':rue' => $adress->getRue(),
                    ':ville' => $adress->getVille(),
                    ':code_postal' => $adress->getCodePostal(),
                    ':pays' => $adress->getPays(),
                    ':numero' =>$adress->getNumero(),
                    ':province' => $adress->getProvince()
                ]);
        
                $idAdress = $connexion->lastInsertId();
                $this->linkerAdressUtilisateur($id_utilisateur, $idAdress);

                $connexion->commit(); 
            } catch (Exception $e) {
                $connexion->rollBack(); 
                throw new Exception("Erreur lors de l'ajout de l'adresse : " . $e->getMessage());
            }
        }

        //Linker l'id de l'adress et l'id de l'utilisateur dans la bd 
        private function linkerAdressUtilisateur(int $id_utilisateur, int $id_adress): void {
            try {
                $sql = "INSERT INTO adresse_utilisateur (id_adresse, id_utilisateur) 
                        VALUES (:id_adresse, :id_utilisateur)";
        
                $connexion = Database::recupererConnexion();
                $requette = $connexion->prepare($sql);
                $requette->execute([
                    ':id_adresse' => $id_adress,
                    ':id_utilisateur' => $id_utilisateur
                ]);
            } catch (Exception $e) {
                throw new Exception("Erreur lors de l'ajout de l'association adresse/utilisateur : " . $e->getMessage());
            }
        }
        
        //Recuperer l'adress d'un utilisateur dans la bd. Retourne null si l'utilisateur n'a pas d'adress
        private function recupererAdressUtilisateur(int $id_utilisateur): ?array {
            try {
                $sql = "SELECT a.*, au.id_adresse 
                        FROM adresse a 
                        JOIN adresse_utilisateur au 
                        ON a.id_adresse = au.id_adresse  
                        WHERE au.id_utilisateur = :id_utilisateur";
                
                $connexion = Database::recupererConnexion();
                $requette = $connexion->prepare($sql);
                $requette->execute([':id_utilisateur' => $id_utilisateur]);
                
                $resultat = $requette->fetch(PDO::FETCH_ASSOC);
                return $resultat ?: null;
            } catch (Exception $e) {
                throw new Exception("Erreur lors de la récupération de l'adresse de l'utilisateur : " . $e->getMessage());
            }
        }

        //Renvoie l'adress d'un utilisateur en chaine . 
        public function recupererChaineAdressUtilisateur($idUtilisateur) : string {
            $adresse = $this->recupererAdressUtilisateur($idUtilisateur);
            if ($adresse) {
                return  htmlspecialchars($adresse['numero'].' '.$adresse['rue'].' '.$adresse['ville'].' '.$adresse['province'].' '.$adresse['pays'].' '.$adresse['code_postal']);
            } else {
                return 'Adresse non disponible';
            }
        }
    }
    
?>
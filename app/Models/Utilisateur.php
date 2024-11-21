<?php
namespace App\Models;
use DateTime ; 

class Utilisateur {
    private int $id; 
    private string $nom;
    private string $prenom;
    private string $dateNaissance;
    private string $courriel;
    private string $motDePasse;
    private string $telephone;
    private string $role;
    private string $adresse ; 

    public function __construct(int $id=null,string $nom, string $prenom, string $dateNaissance, string $courriel, string $motDePasse, string $telephone, string $role, string $adresse = null) {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->dateNaissance = $dateNaissance;
        $this->courriel = $courriel;
        $this->motDePasse = $motDePasse;
        $this->telephone = $telephone;
        $this->role = $role; 
        $this->adresse = $adresse;
    }

    // Méthode statique pour créer un utilisateur à partir d'un tableau
    public static function InitialiserAvecTableau(array $donnee): self {
        return new self(
            $donnee['id_utilisateur'] ?? 0, 
            $donnee['nom'] ,
            $donnee['prenom'] ,
            $donnee['date_naissance'] ,
            $donnee['courriel'] ,
            $donnee['mot_de_passe'] ?? '',
            $donnee['telephone'] ,
            $donnee['description'], //description , ici, fais allusion a role (descirption du role)
            $donnee['adresse'] ?? ''
        );
    }

    // Getters
    public function getNom(): string {
        return $this->nom;
    }

    public function getPrenom(): string {
        return $this->prenom;
    }

    public function getDateNaissance(): string {
        return $this->dateNaissance;
    }

    public function getCourriel(): string {
        return $this->courriel;
    }

    public function getMotDePasse(): string {
        return $this->motDePasse;
    }

    public function getTelephone(): string {
        return $this->telephone;
    }

    public function getRole(): string {
        return $this->role;
    }

    public function getAdresse(): string {
        return $this->adresse;
    }



    // Setters
    public function setNom(string $nom): void {
        $this->nom = $nom;
    }

    public function setPrenom(string $prenom): void {
        $this->prenom = $prenom;
    }

    public function setDateNaissance(string $dateNaissance): void {
        $this->dateNaissance = $dateNaissance;
    }

    public function setCourriel(string $courriel): void {
        $this->courriel = $courriel;
    }

    public function setMotDePasse(string $motDePasse): void {
        $this->motDePasse = $motDePasse;
    }

    public function setTelephone(string $telephone): void {
        $this->telephone = $telephone;
    }

    public function setRole(string $role): void {
        $this->role = $role;
    }
}
?>

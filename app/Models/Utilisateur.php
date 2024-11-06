<?php
namespace App\Models;
use DateTime ; 

class Utilisateur {
    private string $nom;
    private string $prenom;
    private string $dateNaissance;
    private string $courriel;
    private string $motDePasse;
    private string $telephone;
    private string $role;
    private Adresse $adresse ; 

    public function __construct(string $nom, string $prenom, string $dateNaissance, string $courriel, string $motDePasse, string $telephone, string $role) {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->dateNaissance = $dateNaissance;
        $this->courriel = $courriel;
        $this->motDePasse = $motDePasse;
        $this->telephone = $telephone;
        $this->role = $role; 
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

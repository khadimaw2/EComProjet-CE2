<?php
namespace App\Models ; 

class Commande
{
    private int $idCommande;
    private string $date;
    private int $quantite;
    private int $prixTotal;
    private int $idUtilisateur;
    private array $produits;
    private int $statut;

    // Constructeur
    public function __construct(
        int $idCommande, 
        string $date = "", 
        int $quantite, 
        int $prixTotal, 
        int $idUtilisateur, 
        array $produits, 
        int $statut
    ) {
        $this->idCommande = $idCommande;
        $this->date = $date ?: date("Y-m-d H:i:s"); 
        $this->quantite = $quantite;
        $this->prixTotal = $prixTotal;
        $this->idUtilisateur = $idUtilisateur;
        $this->produits = $produits;
        $this->statut = $statut;
    }

    // Méthode statique pour créer une commande à partir d'un tableau
    public static function InitialiserAvecTableau(array $donnee): self {
        return new self(
            $donnee['id_commande'] ?? 0,
            $donnee['date_commande'] ?? '',
            $donnee['quantite_commande'] ?? 0, 
            $donnee['prix_total'] ?? 0, 
            $donnee['id_utilisateur'] ?? 0, 
            isset($donnee['produits']) ? json_decode($donnee['produits'], true) : [],
            $donnee['livree'] ?? 0 
        );
    }

    //Getters

    public function getIdCommande(): int
    {
        return $this->idCommande;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function getQuantite(): int
    {
        return $this->quantite;
    }

    public function getPrixTotal(): int
    {
        return $this->prixTotal;
    }

    public function getIdUtilisateur(): int
    {
        return $this->idUtilisateur;
    }

    public function getProduits(): array
    {
        return $this->produits;
    }

    public function getStatut(): int
    {
        return $this->statut;
    }

    // Setters
    public function setDate(string $date): void
    {
        $this->date = $date;
    }

    public function setQuantite(int $quantite): void
    {
        $this->quantite = $quantite;
    }

    public function setPrixTotal(int $prixTotal): void
    {
        $this->prixTotal = $prixTotal;
    }

    public function setIdUtilisateur(int $idUtilisateur): void
    {
        $this->idUtilisateur = $idUtilisateur;
    }

    public function setProduits(array $produits): void
    {
        $this->produits = $produits;
    }
}

?>
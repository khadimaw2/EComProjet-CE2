<?php
namespace App\Models ; 

class Commande
{
    private string $date;
    private int $quantite;
    private int $prixTotal;
    private int $idUtilisateur;
    private array $produits;

    // Constructeur
    public function __construct(string $date = "", int $quantite = 0, int $prixTotal, int $idUtilisateur = 0, array $produits) {
        $this->date = $date ?: date("Y-m-d H:i:s"); 
        $this->quantite = $quantite;
        $this->prixTotal = $prixTotal;
        $this->idUtilisateur = $idUtilisateur;
        $this->produits = $produits;
    }

    //Getters
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
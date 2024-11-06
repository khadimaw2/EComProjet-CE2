<?php
namespace App\Models;
class Adresse {
    private string $rue;
    private string $ville;
    private string $codePostal;
    private string $pays;
    private string $numero;
    private string $province;

    public function __construct(string $rue, string $ville, string $codePostal, string $pays, string $numero, string $province) {
        $this->rue = $rue;
        $this->ville = $ville;
        $this->codePostal = $codePostal;
        $this->pays = $pays;
        $this->numero = $numero;
        $this->province = $province;
    }

    // Getters
    public function getRue(): string {
        return $this->rue;
    }

    public function getVille(): string {
        return $this->ville;
    }

    public function getCodePostal(): string {
        return $this->codePostal;
    }

    public function getPays(): string {
        return $this->pays;
    }

    public function getNumero(): string {
        return $this->numero;
    }

    public function getProvince(): string {
        return $this->province;
    }

    // Setters 
    public function setRue(string $rue): void {
        $this->rue = $rue;
    }

    public function setVille(string $ville): void {
        $this->ville = $ville;
    }

    public function setCodePostal(string $codePostal): void {
        $this->codePostal = $codePostal;
    }

    public function setPays(string $pays): void {
        $this->pays = $pays;
    }

    public function setNumero(string $numero): void {
        $this->numero = $numero;
    }

    public function setProvince(string $province): void {
        $this->province = $province;
    }

    // Méthode pour modifier l'adresse (exemple)
    public function modifier(array $nouvellesValeurs): bool {
        if(isset($nouvellesValeurs['rue'])) $this->rue = $nouvellesValeurs['rue'];
        if(isset($nouvellesValeurs['ville'])) $this->ville = $nouvellesValeurs['ville'];
        if(isset($nouvellesValeurs['codePostal'])) $this->codePostal = $nouvellesValeurs['codePostal'];
        if(isset($nouvellesValeurs['pays'])) $this->pays = $nouvellesValeurs['pays'];
        if(isset($nouvellesValeurs['numero'])) $this->numero = $nouvellesValeurs['numero'];
        if(isset($nouvellesValeurs['province'])) $this->province = $nouvellesValeurs['province'];
        return true; // Retourne true si la modification est réussie
    }

    // Méthode pour récupérer l'adresse (par exemple en fonction de son ID)
    public static function recuperer(int $id): ?Adresse {
        // Logique pour récupérer les informations de l'adresse en base de données ici
        // Exemple fictif pour retourner une adresse
        return new Adresse("Rue Exemple", "Ville Exemple", "12345", "Pays Exemple", "123", "Province Exemple");
    }
}
?>

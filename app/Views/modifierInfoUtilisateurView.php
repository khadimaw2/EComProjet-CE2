<?php
require_once 'header.php';
use App\Services\ValidateurDeFormulaire;
?>

<body>
    <div class="container mt-5">
        <!-- Titre de la page -->
        <div class="row">
            <div class="col-12 text-center my-4">
                <h1 class="page-title text-success">Modification d'information personnelle</h1>
            </div>
        </div>

        <!-- Messages d'erreur globaux -->
        <?php if (isset($errors["modification"])): ?>
            <div class="row">
                <div class="alert alert-light col-12 text-center my-4" role="alert">
                    <?php echo $errors["modification"]; ?>
                </div>
            </div>
        <?php endif; ?>

        <?php if (isset($errors["echecModification"])): ?>
            <div class="row">
                <div class="alert alert-danger col-12 text-center my-4" role="alert">
                    <?php echo $errors["echecModification"]; ?>
                </div>
            </div>
        <?php endif; ?>

        <!-- Formulaire -->
        <form method="post" enctype="multipart/form-data">
            <!-- Champ : Nom -->
            <div class="mb-3">
                <input 
                    type="text" 
                    id="nom" 
                    placeholder="Entrez votre nom" 
                    class="form-control <?php echo !empty($errors["nom"]) ? 'is-invalid' : ''; ?>" 
                    value="<?php $values["nom"] ?? $utilisateur->getNom() ;  ?>" 
                    name="nom">
                <?php 
                    if (isset($errors["nom"])) {
                        ValidateurDeFormulaire::erreurAffichage($errors["nom"]);
                    }
                ?>
            </div>

            <!-- Champ : Prénom -->
            <div class="mb-3">
                <input 
                    type="text" 
                    id="prenom" 
                    placeholder="Entrez votre prénom" 
                    class="form-control <?php echo !empty($errors["prenom"]) ? 'is-invalid' : ''; ?>" 
                    value="<?php $values["prenom"] ?? $utilisateur->getPrenom() ;  ?>" 
                    name="prenom">
                <?php 
                    if (isset($errors["prenom"])) {
                        ValidateurDeFormulaire::erreurAffichage($errors["prenom"]);
                    }
                ?>
            </div>

            <!-- Champ : Date de naissance -->
            <div class="mb-3">
                <input 
                    type="date" 
                    id="date_naissance" 
                    class="form-control <?php echo !empty($errors["date_naissance"]) ? 'is-invalid' : ''; ?>" 
                    value="<?php $values["date_naissance"] ?? $utilisateur->getDateNaissance() ;  ?>" 
                    name="date_naissance">
                <?php 
                    if (isset($errors["date_naissance"])) {
                        ValidateurDeFormulaire::erreurAffichage($errors["date_naissance"]);
                    }
                ?>
            </div>

            <!-- Champ : Courriel -->
            <div class="mb-3">
                <input 
                    type="email" 
                    id="courriel" 
                    placeholder="Entrez votre courriel" 
                    class="form-control <?php echo !empty($errors["courriel"]) ? 'is-invalid' : ''; ?>" 
                    value="<?php $values["courriel"] ?? $utilisateur->getCourriel() ;  ?>" 
                    name="courriel">
                <?php 
                    if (isset($errors["courriel"])) {
                        ValidateurDeFormulaire::erreurAffichage($errors["courriel"]);
                    }
                ?>
            </div>

            <!-- Champ : Téléphone -->
            <div class="mb-3">
                <input 
                    type="text" 
                    id="telephone" 
                    placeholder="Entrez votre numéro de téléphone" 
                    class="form-control <?php echo !empty($errors["telephone"]) ? 'is-invalid' : ''; ?>" 
                    value="<?php $values["telephone"] ?? $utilisateur->getTelephone() ;  ?>" 
                    name="telephone">
                <?php 
                    if (isset($errors["telephone"])) {
                        ValidateurDeFormulaire::erreurAffichage($errors["telephone"]);
                    }
                ?>
            </div>

            <!-- Champ : Mot de passe -->
            <div class="mb-3">
                <input 
                    type="password" 
                    id="mot_de_passe" 
                    placeholder="Entrez votre mot de passe" 
                    class="form-control <?php echo !empty($errors["mot_de_passe"]) ? 'is-invalid' : ''; ?>" 
                    name="mot_de_passe">
                <?php 
                    if (isset($errors["mot_de_passe"])) {
                        ValidateurDeFormulaire::erreurAffichage($errors["mot_de_passe"]);
                    }
                ?>
            </div>

            <!-- Champ : Confirmation du mot de passe -->
            <div class="mb-3">
                <input 
                    type="password" 
                    id="c_mot_de_passe" 
                    placeholder="Confirmez votre mot de passe" 
                    class="form-control <?php echo !empty($errors["c_mot_de_passe"]) ? 'is-invalid' : ''; ?>" 
                    name="c_mot_de_passe">
                <?php 
                    if (isset($errors["c_mot_de_passe"])) {
                        ValidateurDeFormulaire::erreurAffichage($errors["c_mot_de_passe"]);
                    }
                ?>
            </div>

            <!-- Bouton de modification -->
            <div class="d-grid gap-2">
                <button type="submit" name="modification" class="btn btn-success">
                    Modifier
                </button>
            </div>
        </form>
    </div>
</body>
</html>

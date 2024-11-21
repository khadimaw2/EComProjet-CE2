<?php
require_once 'header.php';
use App\Services\ValidateurDeFormulaire;
?>

<body>
    <div class="container mt-5">
        <!-- Titre de la page -->
        <div class="row">
            <div class="col-12 text-center my-4">
                <h1 class="page-title text-success fw-bold">Inscription</h1>
                <p class="text-muted">Veuillez remplir les champs pour créer un compte</p>
            </div>
        </div>

        <!-- Formulaire d'inscription -->
        <div class="row justify-content-center">
            <div class="col-md-6 col-sm-12">
                <div class="card shadow">
                    <div class="card-body">
                        <form method="post">
                            <div class="mb-3">
                                <input 
                                    type="text" 
                                    id="nom" 
                                    placeholder="Entrez votre nom" 
                                    class="form-control <?php echo !empty($errors["nom"]) ? 'is-invalid' : ''; ?>" 
                                    value="<?php echo htmlspecialchars($values["nom"] ?? ''); ?>" 
                                    name="nom">
                                <?php 
                                    if (isset($errors["nom"])) {
                                        ValidateurDeFormulaire::erreurAffichage($errors["nom"]);
                                    }
                                ?>
                            </div>

                            <div class="mb-3">
                                <input 
                                    type="text" 
                                    id="prenom" 
                                    placeholder="Entrez votre prénom" 
                                    class="form-control <?php echo !empty($errors["prenom"]) ? 'is-invalid' : ''; ?>" 
                                    value="<?php echo htmlspecialchars($values["prenom"] ?? ''); ?>" 
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
                                    value="<?php echo htmlspecialchars($values["date_naissance"] ?? ''); ?>" 
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
                                    value="<?php echo htmlspecialchars($values["courriel"] ?? ''); ?>" 
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
                                    value="<?php echo htmlspecialchars($values["telephone"] ?? ''); ?>" 
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

                            <!-- Bouton d'inscription -->
                            <div class="d-grid gap-2">
                                <button type="submit" name="inscription" class="btn btn-success fw-bold">
                                    <i class="bi bi-person-check-fill"></i> S'inscrire
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Lien vers la connexion -->
                    <div class="card-footer text-center">
                        <p class="mb-0">Vous avez déjà un compte ?</p>
                        <a href="../publics/connexion.php" class="btn btn-link fw-bold">
                            <i class="bi bi-box-arrow-in-right"></i> Se connecter
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

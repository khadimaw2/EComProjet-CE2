<?php
require_once 'header.php';
use App\Services\ValidateurDeFormulaire;
?>
<body>
    <div class="container mt-5">

        <!-- Titre de la page -->
        <div class="row">
            <div class="col-12 text-center my-4">
                <h1 class="page-title text-success fw-bold">Connexion</h1>
            </div>
        </div>

        <!-- Affichage des erreurs générales -->
        <?php if (isset($errors["echecAuth"])) { ?>
            <div class="row justify-content-center">
                <div class="col-md-6 col-sm-12">
                    <div class="alert alert-danger text-center" role="alert">
                        <i class="bi bi-exclamation-triangle-fill"></i> <?php echo $errors["echecAuth"]; ?>
                    </div>
                </div>
            </div>
        <?php } ?>

        <!-- Formulaire de connexion -->
        <div class="row justify-content-center">
            <div class="col-md-6 col-sm-12">
                <div class="card shadow">
                    <div class="card-body">
                        <form method="post">
                            <div class="mb-3">
                                <label for="courriel" class="form-label fw-bold">Courriel</label>
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

                            <!-- Champ : Mot de passe -->
                            <div class="mb-3">
                                <label for="mot_de_passe" class="form-label fw-bold">Mot de passe</label>
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

                            <!-- Boutons d'action -->
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-success fw-bold" name="btn-connection">
                                    <i class="bi bi-box-arrow-in-right"></i> Se connecter
                                </button>
                                <button type="submit" class="btn btn-secondary fw-bold" name="btn_mot_de_passe_oublie">
                                    <i class="bi bi-question-circle"></i> Mot de passe oublié
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Lien vers l'inscription -->
                    <div class="card-footer text-center">
                        <a class="btn btn-link text-decoration-none fw-bold" href="../publics/inscription.php">
                            <i class="bi bi-person-plus-fill"></i> Pas de compte ? S'inscrire !
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<?php
require_once 'header.php';
use App\Services\ValidateurDeFormulaire;
?>
<body>
    <div class="container mt-5">

        <!-- Titre de la page -->
        <div class="row">
            <div class="col-12 text-center my-4">
                <h1 class="page-title text-success fw-bold">Mot de passe oublié</h1>
            </div>
        </div>


        <!-- Formulaire de récupération du mot de passe -->
        <div class="row justify-content-center">
            <div class="col-md-6 col-sm-12">
                <div class="card shadow">
                    <div class="card-body">
                        <form method="post">
                            
                            <!-- Champ : Mot de passe -->
                            <div class="mb-3">
                                <input 
                                    type="password" 
                                    id="mot_de_passe" 
                                    placeholder="Entrez votre nouveau mot de passe" 
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
                            <input type="hidden" name="courriel" value=<?= htmlspecialchars($courriel)?>>

                            <!-- Boutons d'action -->
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-success fw-bold" name="btn_envoyer_lien">
                                    <i class="bi bi-envelope"></i> Enregistrer
                                </button>
                                <a href="../publics/connexion.php" class="btn btn-secondary fw-bold">
                                    <i class="bi bi-arrow-left"></i> Retour à la connexion
                                </a>
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

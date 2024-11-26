<?php
require_once 'header.php';
use App\Services\ValidateurDeFormulaire;
?>

<body>
    <div class="container mt-5">
        <!-- Titre de la page -->
        <div class="row">
            <div class="col-12 text-center my-4">
                <h1 class="page-title text-success fw-bold">Ajouter une adresse</h1>
                <p class="text-muted">Veuillez remplir les champs ci-dessous pour ajouter une adresse</p>
            </div>
        </div>

        <!-- Formulaire d'ajout d'adresse -->
        <div class="row justify-content-center">
            <div class="col-md-6 col-sm-12">
                <div class="card shadow">
                    <div class="card-body">
                        <form method="post">
                            <!-- Champ : Numéro -->
                            <div class="mb-3">
                                <input 
                                    type="text" 
                                    id="numero" 
                                    placeholder="Numéro" 
                                    class="form-control <?php echo !empty($errors["numero"]) ? 'is-invalid' : ''; ?>" 
                                    value="<?php echo htmlspecialchars($values["numero"] ?? ''); ?>" 
                                    name="numero">
                                <?php 
                                    if (isset($errors["numero"])) {
                                        ValidateurDeFormulaire::erreurAffichage($errors["numero"]);
                                    }
                                ?>
                            </div>

                            <!-- Champ : Rue -->
                            <div class="mb-3">
                                <input 
                                    type="text" 
                                    id="rue" 
                                    placeholder="Rue" 
                                    class="form-control <?php echo !empty($errors["rue"]) ? 'is-invalid' : ''; ?>" 
                                    value="<?php echo htmlspecialchars($values["rue"] ?? ''); ?>" 
                                    name="rue">
                                <?php 
                                    if (isset($errors["rue"])) {
                                        ValidateurDeFormulaire::erreurAffichage($errors["rue"]);
                                    }
                                ?>
                            </div>

                            <!-- Champ : Ville -->
                            <div class="mb-3">
                                <input 
                                    type="text" 
                                    id="ville" 
                                    placeholder="Ville" 
                                    class="form-control <?php echo !empty($errors["ville"]) ? 'is-invalid' : ''; ?>" 
                                    value="<?php echo htmlspecialchars($values["ville"] ?? ''); ?>" 
                                    name="ville">
                                <?php 
                                    if (isset($errors["ville"])) {
                                        ValidateurDeFormulaire::erreurAffichage($errors["ville"]);
                                    }
                                ?>
                            </div>

                            <!-- Champ : Code postal -->
                            <div class="mb-3">
                                <input 
                                    type="text" 
                                    id="code_postal" 
                                    placeholder="Code postal" 
                                    class="form-control <?php echo !empty($errors["code_postal"]) ? 'is-invalid' : ''; ?>" 
                                    value="<?php echo htmlspecialchars($values["code_postal"] ?? ''); ?>" 
                                    name="code_postal">
                                <?php 
                                    if (isset($errors["code_postal"])) {
                                        ValidateurDeFormulaire::erreurAffichage($errors["code_postal"]);
                                    }
                                ?>
                            </div>

                            <!-- Champ : Province -->
                            <div class="mb-3">
                                <input 
                                    type="text" 
                                    id="province" 
                                    placeholder="Province" 
                                    class="form-control <?php echo !empty($errors["province"]) ? 'is-invalid' : ''; ?>" 
                                    value="<?php echo htmlspecialchars($values["province"] ?? ''); ?>" 
                                    name="province">
                                <?php 
                                    if (isset($errors["province"])) {
                                        ValidateurDeFormulaire::erreurAffichage($errors["province"]);
                                    }
                                ?>
                            </div>

                            <!-- Champ : Pays -->
                            <div class="mb-3">
                                <input 
                                    type="text" 
                                    id="pays" 
                                    placeholder="Pays" 
                                    class="form-control <?php echo !empty($errors["pays"]) ? 'is-invalid' : ''; ?>" 
                                    value="<?php echo htmlspecialchars($values["pays"] ?? ''); ?>" 
                                    name="pays">
                                <?php 
                                    if (isset($errors["pays"])) {
                                        ValidateurDeFormulaire::erreurAffichage($errors["pays"]);
                                    }
                                ?>
                            </div>

                            <!-- Bouton de validation -->
                            <div class="d-grid gap-2">
                                <button type="submit" name="valider_adress" class="btn btn-success fw-bold">
                                    <i class="bi bi-save"></i> Valider
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<?php
use App\Services\ValidateurDeFormulaire;
require_once 'header.php';
?>

<body>
    <div class="container mt-5">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center my-4">
                    <h1 class="page-title text-success">Inscription</h1>
                </div>
            </div>
        </div>
    </div>
    <form method="post" class="container ">
        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" class="form-control <?php echo !empty($errors["nom"]) ? 'is-invalid' : ''; ?>"  value="<?php echo htmlspecialchars($values["nom"] ?? ''); ?>" name="nom">
            <?php 
                if (isset($errors["nom"])) {
                    ValidateurDeFormulaire::erreurAffichage($errors["nom"]);
                }
            ?>
        </div>

        <div class="mb-3">
            <label for="prenom" class="form-label">Prenom</label>
            <input type="text" class="form-control <?php echo !empty($errors["prenom"]) ? 'is-invalid' : ''; ?>" value="<?php echo htmlspecialchars($values["prenom"] ?? ''); ?>" name="prenom">
            <?php 
                if (isset($errors["prenom"])) {
                    ValidateurDeFormulaire::erreurAffichage($errors["prenom"]);
                }
            ?>
        </div>

        <div class="mb-3">
            <label for="date_naissance" class="form-label">Date de naissance</label>
            <input type="date" class="form-control <?php echo !empty($errors["date_naissance"]) ? 'is-invalid' : ''; ?>" value="<?php echo htmlspecialchars($values["date_naissance"] ?? ''); ?>" name="date_naissance">
            <?php 
                if (isset($errors["date_naissance"])) {
                    ValidateurDeFormulaire::erreurAffichage($errors["date_naissance"]);
                }
            ?>
        </div> 

        <div class="mb-3">
            <label for="courriel" class="form-label">Courriel</label>
            <input type="email" placeholder="Entrer votre courriel" class="form-control <?php echo !empty($errors["courriel"]) ? 'is-invalid' : ''; ?>" value="<?php echo htmlspecialchars($values["courriel"] ?? ''); ?>" name="courriel">
            <?php 
                if (isset($errors["courriel"])) {
                    ValidateurDeFormulaire::erreurAffichage($errors["courriel"]);
                }
            ?>
        </div>

        <div class="mb-3">
            <label for="telephone" class="form-label">Téléphone</label>
            <input type="text" placeholder="Entrer votre telephone" class="form-control <?php echo !empty($errors["telephone"]) ? 'is-invalid' : ''; ?>" value="<?php echo htmlspecialchars($values["telephone"] ?? ''); ?>"  name="telephone">
            <?php 
                if (isset($errors["telephone"])) {
                    ValidateurDeFormulaire::erreurAffichage($errors["telephone"]);
                }
            ?>
        </div>

        <div class="mb-3">
            <label for="mot_de_passe" class="form-label">Mot de passe</label>
            <input type="password" class="form-control <?php echo !empty($errors["mot_de_passe"]) ? 'is-invalid' : ''; ?>" value="<?php echo htmlspecialchars($values["mot_de_passe"] ?? ''); ?>" name="mot_de_passe">
            <?php 
                if (isset($errors["mot_de_passe"])) {
                    ValidateurDeFormulaire::erreurAffichage($errors["mot_de_passe"]);
                }
            ?>
        </div>

        <div class="mb-3">
            <label for="c_mot_de_passe" class="form-label">Confirmer votre mot de passe</label>
            <input type="password" class="form-control <?php echo !empty($errors["c_mot_de_passe"]) ? 'is-invalid' : ''; ?>" value="<?php echo htmlspecialchars($values["c_mot_de_passe"] ?? ''); ?>" name="c_mot_de_passe">
            <?php 
                if (isset($errors["c_mot_de_passe"])) {
                    ValidateurDeFormulaire::erreurAffichage($errors["c_mot_de_passe"]);
                }
            ?>
        </div>

        <input type="submit" name="inscription" class="btn btn-success" value="Inscription">
    </form>
</body>
</html>
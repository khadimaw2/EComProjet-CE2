<?php
use App\Services\ValidateurDeFormulaire;
require_once 'header.php';
?>
</body>
    <div class="container mt-5">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center my-4">
                    <h1 class="page-title text-success">Connexion</h1>
                </div>
            </div>
        </div>

        <?php if (isset($errors["echecAuth"])) {?>
            <div class="row">
                <div class="alert alert-danger col-12 text-center my-4" role="alert"> 
                    <?php echo $errors["echecAuth"];?>
                </div>
            </div>
        <?php } ?> 

        <form method="post" >
            <div class="mb-3">
                <input type="email" placeholder="Entrez votre courriel" class="form-control <?php echo !empty($errors["courriel"]) ? 'is-invalid' : ''; ?>" value="<?php echo htmlspecialchars($values["courriel"] ?? ''); ?>" name="courriel">
                <?php 
                    if (isset($errors["courriel"])) {
                        ValidateurDeFormulaire::erreurAffichage($errors["courriel"]);
                    }
                ?>
            </div>

            <div class="mb-3">
                <input type="password"  placeholder="Entrez votre mot de passe" class="form-control <?php echo !empty($errors["mot_de_passe"]) ? 'is-invalid' : ''; ?>" value="<?php echo htmlspecialchars($values["mot_de_passe"] ?? ''); ?>" name="mot_de_passe">
                <?php 
                    if (isset($errors["mot_de_passe"])) {
                        ValidateurDeFormulaire::erreurAffichage($errors["mot_de_passe"]);
                    }
                ?>
            </div>

            <div>
                <input type="submit"  class="btn btn-success" value="Se connecter" name="btn-connection">
                <input type="submit"  class="btn btn-secondary" value="Mot de passe oublie" name="btn_mot_de_passe_oublie"><br>
                <a class="btn btn-link" href='../publics/inscription.php'>Pas de compte - S'inscrire !</a>
            </div>
        </form>
    </div>
</body>
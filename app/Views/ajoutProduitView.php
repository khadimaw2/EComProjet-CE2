<?php
use App\Services\ValidateurDeFormulaire;
require_once 'header.php';
?>

<body>
    <div class="container mt-5">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center my-4">
                <h1 class="page-title text-success">Ajouter produit</h1>
                </div>
            </div>
        </div>

        <form method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <input type="text" class="form-control <?php echo !empty($errors["nom"]) ? 'is-invalid' : ''; ?>" placeholder="Entrez le nom du produit" value="<?php echo htmlspecialchars($values["nom"] ?? ''); ?>" id="nom" name="nom">
                <?php 
                    if (isset($errors["nom"])) {
                        ValidateurDeFormulaire::erreurAffichage($errors["nom"]);
                    }
                ?>
            </div>

            <div class="mb-3">
                <input type="number" class="form-control <?php echo !empty($errors["prix_unitaire"]) ? 'is-invalid' : ''; ?>" placeholder="Entrez le prix unitaire" value="<?php echo htmlspecialchars($values["prix_unitaire"] ?? ''); ?>" id="prix_unitaire" name="prix_unitaire">
                <?php 
                    if (isset($errors["prix_unitaire"])) {
                        ValidateurDeFormulaire::erreurAffichage($errors["prix_unitaire"]);
                    }
                ?>
            </div>

            <div class="mb-3">
                <input type="number" min="0" class="form-control <?php echo !empty($errors["quantite"]) ? 'is-invalid' : ''; ?>" placeholder="Entrez la quantite" value="<?php echo htmlspecialchars($values["quantite"] ?? ''); ?>" id="quantite" name="quantite">
                <?php 
                    if (isset($errors["quantite"])) {
                        ValidateurDeFormulaire::erreurAffichage($errors["quantite"]);
                    }
                ?>
            </div>

            <div class="mb-3">
                <input type="file" class="form-control <?php echo !empty($errors["image"]) ? 'is-invalid' : ''; ?>" id="image" value="<?php echo htmlspecialchars($values["image"] ?? ''); ?>" name="image">
                <?php 
                    if (isset($errors["image"])) {
                        ValidateurDeFormulaire::erreurAffichage($errors["image"]);
                    }
                ?>
            </div>

            <div class="form-floating mb-3">
                <textarea class="form-control <?php echo !empty($errors["courte_description"]) ? 'is-invalid' : ''; ?>" placeholder="Entrez la courte description"  name="courte_description"
                        id="courte_description"><?php echo htmlspecialchars($values["courte_description"] ?? ''); ?></textarea>
                <label for="floatingTextarea">Entrez la courte description</label>
                <?php 
                    if (isset($errors["courte_description"])) {
                        ValidateurDeFormulaire::erreurAffichage($errors["courte_description"]);
                    }
                ?>
            </div>

            <div class="form-floating mb-3">
                <textarea class="form-control <?php echo !empty($errors["description"]) ? 'is-invalid' : ''; ?>" placeholder="Entrez la description" name="description" id="description"><?php echo htmlspecialchars($values["description"] ?? ''); ?></textarea>
                <label for="floatingTextarea">Entrez la description</label>
                <?php 
                    if (isset($errors["description"])) {
                        ValidateurDeFormulaire::erreurAffichage($errors["description"]);
                    }
                ?>
            </div>

            <div class="input-group mb-3">
                <select class="form-select <?php echo !empty($errors["categorie"]) ? 'is-invalid' : ''; ?>" id="inputGroupSelect01" name ="id_categorie">
                    <option selected>Categorie</option>
                    <option value=1 <?php echo (isset($values["categorie"]) && $values["categorie"] ==1) ? 'selected' :''; ?>>Soin de corps</option>
                    <option value=2 <?php echo (isset($values["categorie"]) && $values["categorie"] == 2) ? 'selected' :''; ?>>Soin de cheveux</option>
                </select>
                <?php if (isset($errors["categorie"])) {
                    ValidateurDeFormulaire::erreurAffichage($errors["categorie"]);
                }?>
            </div>

            <input type="submit" class="btn btn-success" name="btn-ajout" value="Ajouter un produit">
        </form>
    </div>
</body>
</html>
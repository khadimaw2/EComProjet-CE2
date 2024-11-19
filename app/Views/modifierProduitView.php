<?php
require_once 'header.php';
use App\Services\ValidateurDeFormulaire;
?>
<body>
    <div class="container mt-5">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center my-4">
                    <h1 class="page-title text-success">Modifier produit</h1>
                </div>
            </div>
        </div>

        <form method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <input type="text" 
                       class="form-control <?php echo !empty($errors["nom"]) ? 'is-invalid' : ''; ?>" 
                       placeholder="Entrez le nom du produit" 
                       value="<?php echo htmlspecialchars($values["nom"] ?? $produit->getNom()); ?>" 
                       id="nom" 
                       name="nom">
                <?php 
                    if (isset($errors["nom"])) {
                        ValidateurDeFormulaire::erreurAffichage($errors["nom"]);
                    }
                ?>
            </div>

            <div class="mb-3">
                <input type="number" 
                       class="form-control <?php echo !empty($errors["prix_unitaire"]) ? 'is-invalid' : ''; ?>" 
                       placeholder="Entrez le prix unitaire" 
                       value="<?php echo htmlspecialchars($values["prix_unitaire"] ?? $produit->getPrixUnitaire()); ?>" 
                       id="prix_unitaire" 
                       name="prix_unitaire">
                <?php 
                    if (isset($errors["prix_unitaire"])) {
                        ValidateurDeFormulaire::erreurAffichage($errors["prix_unitaire"]);
                    }
                ?>
            </div>

            <div class="mb-3">
                <input type="number" 
                       min="0" 
                       class="form-control <?php echo !empty($errors["quantite"]) ? 'is-invalid' : ''; ?>" 
                       placeholder="Entrez la quantité" 
                       value="<?php echo htmlspecialchars($values["quantite"] ?? $produit->getQuantite()); ?>" 
                       id="quantite" 
                       name="quantite">
                <?php 
                    if (isset($errors["quantite"])) {
                        ValidateurDeFormulaire::erreurAffichage($errors["quantite"]);
                    }
                ?>
            </div>

            <div class="mb-3">
                <input type="file" 
                       class="form-control <?php echo !empty($errors["image"]) ? 'is-invalid' : ''; ?>" 
                       id="image" 
                       name="image">
                <?php 
                    if (isset($errors["image"])) {
                        ValidateurDeFormulaire::erreurAffichage($errors["image"]);
                    }
                ?>
                <?php if (!empty($produit->getcheminImage())): ?>
                    <img src="<?= htmlspecialchars('../ressources/'.$produit->getcheminImage()); ?>" alt="Image du produit" style="max-width: 100px; max-height: 100px; margin-top: 10px;">
                <?php endif; ?>
            </div>

            <div class="form-floating mb-3">
                <textarea class="form-control <?php echo !empty($errors["courte_description"]) ? 'is-invalid' : ''; ?>" 
                          placeholder="Entrez la courte description" 
                          name="courte_description" 
                          id="courte_description"><?php echo htmlspecialchars($values["courte_description"] ?? $produit->getCourteDescription()); ?></textarea>
                <label for="courte_description">Courte description</label>
                <?php 
                    if (isset($errors["courte_description"])) {
                        ValidateurDeFormulaire::erreurAffichage($errors["courte_description"]);
                    }
                ?>
            </div>

            <div class="form-floating mb-3">
                <textarea class="form-control <?php echo !empty($errors["description"]) ? 'is-invalid' : ''; ?>" 
                          placeholder="Entrez la description" 
                          name="description" 
                          id="description"><?php echo htmlspecialchars($values["description"] ?? $produit->getDescription()); ?></textarea>
                <label for="description">Description</label>
                <?php 
                    if (isset($errors["description"])) {
                        ValidateurDeFormulaire::erreurAffichage($errors["description"]);
                    }
                ?>
            </div>

            <div class="input-group mb-3">
                <select class="form-select <?php echo !empty($errors["categorie"]) ? 'is-invalid' : ''; ?>" 
                        id="inputGroupSelect01" 
                        name="id_categorie">
                    <option selected>Categorie</option>
                    <option value=1 <?php echo (isset($values["id_categorie"]) && $values["id_categorie"] == 1) || $produit->getIdCategorie() == 1 ? 'selected' : ''; ?>>Soin de corps</option>
                    <option value=2 <?php echo (isset($values["id_categorie"]) && $values["id_categorie"] == 2) || $produit->getIdCategorie() == 2 ? 'selected' : ''; ?>>Soin de cheveux</option>
                </select>
                <?php 
                    if (isset($errors["categorie"])) {
                        ValidateurDeFormulaire::erreurAffichage($errors["categorie"]);
                    }
                ?>
            </div>

            <input type="submit" class="btn btn-success" name="btn-mdp" value="Modifier un produit">
        </form>
    </div>
</body>
</html>

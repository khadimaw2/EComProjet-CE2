<?php
// Inclusion de la classe ValidateurDeFormulaire
use App\Services\ValidateurDeFormulaire;
// Inclusion du fichier d'en-tête
require_once 'header.php';
?>

<body>
    <div class="container mt-5">

        <!-- Titre de la page -->
        <div class="row">
            <div class="col-12 text-center my-4">
                <h1 class="page-title text-success fw-bold">Ajouter produit</h1>
            </div>
        </div>

        <!-- Affichage des erreurs générales (si nécessaire) -->
        <?php if (!empty($errors["general"])) { ?>
            <div class="row">
                <div class="alert alert-danger col-12 text-center" role="alert">
                    <i class="bi bi-exclamation-triangle-fill"></i> <?php echo $errors["general"]; ?>
                </div>
            </div>
        <?php } ?> 

        <!-- Formulaire dans une carte -->
        <div class="row justify-content-center">
            <div class="col-md-8 col-sm-12">
                <div class="card shadow">
                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data">
                            <!-- Champ : Nom du produit -->
                            <div class="mb-3">
                                <input 
                                    type="text" 
                                    id="nom" 
                                    placeholder="Entrez le nom du produit" 
                                    class="form-control <?php echo !empty($errors["nom"]) ? 'is-invalid' : ''; ?>" 
                                    value="<?php echo htmlspecialchars($values["nom"] ?? ''); ?>" 
                                    name="nom">
                                <?php 
                                    if (isset($errors["nom"])) {
                                        ValidateurDeFormulaire::erreurAffichage($errors["nom"]);
                                    }
                                ?>
                            </div>

                            <!-- Champ : Prix unitaire -->
                            <div class="mb-3">
                                <input 
                                    type="number" 
                                    id="prix_unitaire" 
                                    placeholder="Entrez le prix unitaire" 
                                    class="form-control <?php echo !empty($errors["prix_unitaire"]) ? 'is-invalid' : ''; ?>" 
                                    value="<?php echo htmlspecialchars($values["prix_unitaire"] ?? ''); ?>" 
                                    name="prix_unitaire">
                                <?php 
                                    if (isset($errors["prix_unitaire"])) {
                                        ValidateurDeFormulaire::erreurAffichage($errors["prix_unitaire"]);
                                    }
                                ?>
                            </div>

                            <!-- Champ : Quantité -->
                            <div class="mb-3">
                                <input 
                                    type="number" 
                                    id="quantite" 
                                    min="0" 
                                    placeholder="Entrez la quantité" 
                                    class="form-control <?php echo !empty($errors["quantite"]) ? 'is-invalid' : ''; ?>" 
                                    value="<?php echo htmlspecialchars($values["quantite"] ?? ''); ?>" 
                                    name="quantite">
                                <?php 
                                    if (isset($errors["quantite"])) {
                                        ValidateurDeFormulaire::erreurAffichage($errors["quantite"]);
                                    }
                                ?>
                            </div>

                            <!-- Champ : Image -->
                            <div class="mb-3">
                                <input 
                                    type="file" 
                                    id="image" 
                                    class="form-control <?php echo !empty($errors["image"]) ? 'is-invalid' : ''; ?>" 
                                    name="image">
                                <?php 
                                    if (isset($errors["image"])) {
                                        ValidateurDeFormulaire::erreurAffichage($errors["image"]);
                                    }
                                ?>
                            </div>

                            <!-- Champ : Courte description -->
                            <div class="mb-3">
                                <textarea 
                                    id="courte_description" 
                                    placeholder="Entrez la courte description" 
                                    class="form-control <?php echo !empty($errors["courte_description"]) ? 'is-invalid' : ''; ?>" 
                                    name="courte_description"><?php echo htmlspecialchars($values["courte_description"] ?? ''); ?></textarea>
                                <?php 
                                    if (isset($errors["courte_description"])) {
                                        ValidateurDeFormulaire::erreurAffichage($errors["courte_description"]);
                                    }
                                ?>
                            </div>

                            <!-- Champ : Description complète -->
                            <div class="mb-3">
                                <textarea 
                                    id="description" 
                                    placeholder="Entrez la description complète" 
                                    class="form-control <?php echo !empty($errors["description"]) ? 'is-invalid' : ''; ?>" 
                                    name="description"><?php echo htmlspecialchars($values["description"] ?? ''); ?></textarea>
                                <?php 
                                    if (isset($errors["description"])) {
                                        ValidateurDeFormulaire::erreurAffichage($errors["description"]);
                                    }
                                ?>
                            </div>

                            <!-- Champ : Catégorie -->
                            <div class="mb-3">
                                <select 
                                    id="id_categorie" 
                                    class="form-select <?php echo !empty($errors["categorie"]) ? 'is-invalid' : ''; ?>" 
                                    name="id_categorie">
                                    <option value="" selected disabled>Choisissez une catégorie</option>
                                    <option value="1" <?php echo (isset($values["categorie"]) && $values["categorie"] == 1) ? 'selected' : ''; ?>>Soin de corps</option>
                                    <option value="2" <?php echo (isset($values["categorie"]) && $values["categorie"] == 2) ? 'selected' : ''; ?>>Soin de cheveux</option>
                                </select>
                                <?php 
                                    if (isset($errors["categorie"])) {
                                        ValidateurDeFormulaire::erreurAffichage($errors["categorie"]);
                                    }
                                ?>
                            </div>

                            <!-- Bouton : Soumettre -->
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-success fw-bold" name="btn-ajout">
                                    <i class="bi bi-plus-circle"></i> Ajouter un produit
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

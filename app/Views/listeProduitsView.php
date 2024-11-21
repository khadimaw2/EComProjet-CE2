<?php
require_once 'header.php';
?>
<body>
    <div class="container mt-5">
        <!-- Titre principal -->
        <div class="row">
            <div class="col-12 text-center my-4">
                <h1 class="page-title text-success fw-bold">Gestion des produits</h1>
            </div>
        </div>

        <!-- Bouton pour ajouter un produit -->
        <div class="d-flex justify-content-end mb-4">
            <a class="btn btn-success" href="../publics/ajout-produit.php">
                <i class="bi bi-plus-circle"></i> Ajouter un nouveau produit
            </a>
        </div>

        <!-- Vérification si des produits existent -->
        <?php if (!empty($produits)) { ?>
            <div class="card shadow">
                <div class="card-header --bs-tertiary-color --bs-tertiary-color-rgb text-white">
                    <h5 class="mb-0">Liste des produits</h5>
                </div>
                <div class="card-body">
                    <!-- Tableau des produits -->
                    <table class="table table-striped table-hover table-bordered align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Image</th>
                                <th scope="col">Nom</th>
                                <th scope="col">Quantité</th>
                                <th scope="col">Prix unitaire</th>
                                <th scope="col">Catégorie</th>
                                <th scope="col" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($produits as $produit) { ?>
                                <tr>
                                    <th scope="row"><?= $i++; ?></th>
                                    <td class="text-center">
                                        <img height="50px" width="50px" class="img-thumbnail"
                                             src="<?= (!empty($produit->getcheminImage())) 
                                                 ? '../ressources/' . $produit->getcheminImage()
                                                 : '../ressources/images-produit/image-back.png'; ?>" 
                                             alt="Image produit">
                                    </td>
                                    <td><?= htmlspecialchars($produit->getNom()); ?></td>
                                    <td><?= htmlspecialchars($produit->getQuantite()); ?></td>
                                    <td>$<?= number_format($produit->getPrixUnitaire(), 2); ?></td>
                                    <td><?= htmlspecialchars($produit->getNomCategorie()); ?></td>
                                    <td class="text-center">
                                        <!-- Actions : Modifier et Supprimer -->
                                        <div class="btn-group" role="group">
                                            <!-- Modifier -->
                                            <a class="btn btn-sm btn-primary" title="Modifier"
                                               href="../publics/modifier-produit.php?id=<?= $produit->getId(); ?>">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <!-- Supprimer -->
                                            <form method="POST" action="../publics/liste-produits.php" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?');">
                                                <input type="hidden" name="action" value="supprimer">
                                                <input type="hidden" name="id" value="<?= $produit->getId(); ?>">
                                                <button type="submit" class="btn btn-sm btn-danger" title="Supprimer">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php } else { ?>
            <!-- Message si aucun produit n'est trouvé -->
            <div class="row">
                <div class="col-12 text-center my-5">
                    <div class="alert alert-warning" role="alert">
                        <i class="bi bi-info-circle-fill"></i> Aucun produit trouvé dans le stock.
                    </div>
                    <a class="btn btn-success" href="../publics/ajout-produit.php">
                        <i class="bi bi-plus-circle"></i> Ajouter des produits
                    </a>
                </div>
            </div>
        <?php } ?>
    </div>
</body>
</html>

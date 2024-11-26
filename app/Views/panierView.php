<?php
include 'header.php';
?>
<body>
<div class="container mt-5">
    <!-- Titre principal -->
    <div class="row">
        <div class="col-12 text-center my-4">
            <h1 class="page-title text-success fw-bold">Votre Panier</h1>
        </div>
    </div>

    <?php if (!empty($_SESSION['panier'])) {?>
        <!-- Tableau des produits -->
        <div class="card shadow">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">Détails de votre panier</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped table-hover table-bordered align-middle">
                    <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Image</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Quantité</th>
                        <th scope="col">Prix unitaire</th>
                        <th scope="col" class="text-center">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i = 1;
                    foreach ($panier as $produit) { ?>
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
                            <td><?= $produit->getQteDansLePanier(); ?></td>
                            <td>$<?= number_format($produit->getPrixUnitaire(), 2); ?></td>
                            <?php $totalAPayer += $produit->getPrixUnitaire() * $produit->getQteDansLePanier(); ?>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    <!-- Formulaire pour diminuer la quantité -->
                                    <form method="POST" action="../publics/panier.php" class="d-inline">
                                        <input type="hidden" name="id" value="<?= $produit->getId(); ?>">
                                        <input type="hidden" name="action" value="diminuer">
                                        <button type="submit" class="btn btn-sm btn-secondary" title="Diminuer quantité">
                                            <i class="bi bi-dash"></i>
                                        </button>
                                    </form>

                                    <!-- Formulaire pour augmenter la quantité -->
                                    <form method="POST" action="../publics/panier.php" class="d-inline">
                                        <input type="hidden" name="id" value="<?= $produit->getId(); ?>">
                                        <input type="hidden" name="action" value="augmenter">
                                        <button type="submit" class="btn btn-sm btn-secondary" title="Augmenter quantité">
                                            <i class="bi bi-plus"></i>
                                        </button>
                                    </form>

                                    <!-- Formulaire pour supprimer le produit -->
                                    <form method="POST" action="../publics/panier.php" class="d-inline" 
                                        onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet article du panier ?');">
                                        <input type="hidden" name="id" value="<?= $produit->getId(); ?>">
                                        <input type="hidden" name="action" value="supprimer">
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
            <div class="card-footer text-end fw-bold">
                Total à payer : $<?= number_format($totalAPayer, 2); ?>
            </div>
        </div>

        <?php include 'boutonValidationPanier.php' ?>

    <?php } else { ?>
        <!-- Message si le panier est vide -->
        <div class="row">
            <div class="col-12 text-center my-5">
                <div class="alert alert-warning" role="alert">
                    <i class="bi bi-info-circle-fill"></i> Votre panier est vide.
                </div>
                <a class="btn btn-success" href="store.php">
                    <i class="bi bi-plus-circle"></i> Ajouter des produits
                </a>
            </div>
        </div>
    <?php } ?>
</div>
</body>
</html>

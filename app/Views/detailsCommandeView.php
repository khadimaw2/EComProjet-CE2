<?php
require_once 'header.php';
?>
<body>
    <div class="container mt-5">
        <!-- Titre principal -->
        <div class="row">
            <div class="col-12 text-center my-4">
                <h1 class="page-title text-success fw-bold">Détail des produits de la commande</h1>
            </div>
        </div>

        <!-- Vérification si des produits existent -->
        <?php if (!empty($produits)) { ?>
            <div class="card shadow">
                <div class="card-header bg-success text-white">
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
                                <th scope="col">Quantité Achetée</th>
                                <th scope="col">Prix unitaire</th>
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
                                    <td><?= htmlspecialchars($produit->getQteDansLePanier()); ?></td>
                                    <td>$<?= $produit->getPrixUnitaire(); ?></td>
                                </tr>
                                <?php $totalAPayer += $produit->getPrixUnitaire() * $produit->getQteDansLePanier(); ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer text-end fw-bold text-light" >
                    <h5>
                        Total à payer :
                        <span class="badge text-bg-danger">
                            $<?= number_format($totalAPayer, 2); ?>
                        </span>
                    </h5>
                </div>
            </div>
        <?php } else { ?>
            <!-- Message si aucun produit n'est trouvé -->
            <div class="row">
                <div class="col-12 text-center my-5">
                    <div class="alert alert-warning" role="alert">
                        <i class="bi bi-info-circle-fill"></i> Aucun produit trouvé dans cette commande.
                    </div>
                    <a class="btn btn-success" href="listeToutesLesCommandes.php">
                        <i class="bi bi-arrow-left-circle"></i> Retour
                    </a>
                </div>
            </div>
        <?php } ?>
    </div>
</body>
</html>

<?php
require_once 'header.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../publics/css/detailsProduitStyle.css">
    <title>Détails du produit</title>
</head>

<body data-bs-theme="dark">
    <div class="container product-container">
        <div class="row">
            <div class="col-md-6">
                <img src="<?= !empty($produit->getCheminImage()) ? "../ressources/".$produit->getcheminImage() : '../ressources/images-produit/image-back.png'; ?>" alt="Image du produit" class="img-fluid product-image">
            </div>
            <div class="col-md-6 product-info">
                <h1 class="product-title"><?= $produit->getNom(); ?></h1>
                <h3 class="product-price"><?= $produit->getPrixUnitaire(); ?> $</h3>
                <p class="product-description"><?= $produit->getCourteDescription(); ?></p>
                <p class="product-description"><?= $produit->getDescription(); ?></p>
                <form method="POST" action="../publics/details-produit.php" class="d-inline">
                    <input type="hidden" name="id" value="<?= $produit->getId(); ?>">
                    <input type="hidden" name="action" value="ajouter-au-panier">
                    <button type="submit" class="btn add-to-cart"" title="Augmenter quantité">
                        Ajouter au panier
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

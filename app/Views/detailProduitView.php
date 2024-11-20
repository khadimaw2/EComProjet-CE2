<?php
require_once '../public/gestionDetailProduit.php'; 
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Détails du produit</title>
    <!-- Inclure Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .product-container {
            margin-top: 30px;
            padding: 20px;
            border-radius: 8px;
            background: #ffffff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .product-image {
            max-height: 500px;
            object-fit: cover;
            border-radius: 8px;
        }
        .product-info {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .product-title {
            font-size: 28px;
            font-weight: bold;
            color: #198754;
        }
        .product-price {
            font-size: 24px;
            color: #333;
        }
        .product-description {
            font-size: 16px;
            color: #6c757d;
            margin-top: 10px;
        }
        .add-to-cart {
            background-color: #198754;
            color: white;
            font-size: 16px;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            transition: 0.3s;
        }
        .add-to-cart:hover {
            background-color: #145b40;
        }
    </style>
</head>
<body>
    <div class="container product-container">
        <div class="row">
            <div class="col-md-6">
                <img src="<?= isset($produit['chemin']) && !empty($produit['chemin']) ? $produit['chemin'] : './images/image-back.png'; ?>" alt="Image du produit" class="img-fluid product-image">
            </div>
            <div class="col-md-6 product-info">
                <h1 class="product-title"><?= $produit['nom']; ?></h1>
                <h3 class="product-price"><?= $produit['prix_unitaire']; ?> $</h3>
                <p class="product-description"><?= $produit['courte_description']; ?></p>
                <p class="product-description"><?= $produit['description']; ?></p>
                <a href="../public/ajoutAuPanier.php?id=<?= $produit['id_produit']; ?>" class="btn add-to-cart">Ajouter au panier</a>
            </div>
        </div>
    </div>

    <!-- Inclure Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

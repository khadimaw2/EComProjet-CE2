<?php
  require_once 'header.php';
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../publics/css/storeStyle.css">
    <title>Store</title>
</head>

<body>
    <div class="container mt-5">
      <div class="row">
        <div class="col-12 text-center my-4">
        <h1 class="page-title text-success d-flex align-items-center justify-content-center fs-1 text">
            <b>Boutique</b>
            <img src="../ressources/shopping-bag-icon-corrected-white (1).png" alt="Shopping Bag Icon" class="me-2" style="width: 100px; height: 100px;">
        </h1>
        <p class="fs-5 opacity-50"> Entrez moche, sortez belle ! / Entrez belle, sortez belle++ !</p>
        </div>
      </div>
    </div>

    <div class="container my-4">
      <div class="d-grid d-md-flex justify-content-md-end">
      <a class="btn btn-success position-relative" href="panier.php">
          <i class="bi bi-cart3"></i>
          <?php if ($qteProduitDansLePanier  > 0): ?>
              <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                  <?= $qteProduitDansLePanier ?>
                  <span class="visually-hidden">produits dans le panier</span>
              </span>
          <?php endif; ?>
      </a>
      </div>
      
      <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
          <a class="nav-link text-success active" id="category1-tab" data-bs-toggle="tab" href="#category1" role="tab" aria-controls="categorieTout" aria-selected="true">Tout</a>
        </li>
        <li class="nav-item" role="presentation">
          <a class="nav-link text-success" id="category2-tab" data-bs-toggle="tab" href="#category2" role="tab" aria-controls="categorieCapillaire" aria-selected="false">Produits capillaires</a>
        </li>
        <li class="nav-item" role="presentation">
          <a class="nav-link text-success" id="category3-tab" data-bs-toggle="tab" href="#category3" role="tab" aria-controls="categorieCorporelle" aria-selected="false">Produits Corporels</a>
        </li>
      </ul>
      
      <div class="tab-content" id="myTabContent">

        <!-- Section "Tout" -->
        <div class="tab-pane fade show active" id="category1" role="tabpanel" aria-labelledby="categorieTout-tab">
          <div class="row">
            <?php if (!empty($produits)) : ?>

              <?php foreach ($produits as $produit) : ?>
                <?php $estEnStock = $produit->getQuantite() > 0; ?>
                <div class="col-sm-6 col-md-4 col-lg-3 mb-4">

                  <?php include 'affichageProduitStore.php' ?>
    
                </div>
              <?php endforeach; ?>
            <?php else : ?>
              <p>Aucun produit disponible pour le moment.</p>
            <?php endif; ?>
          </div>
        </div>

        <!-- Section "Produits capillaires" -->
        <div class="tab-pane fade" id="category2" role="tabpanel" aria-labelledby="categorieCapillaire-tab">
          <div class="row">
            <?php foreach ($produits as $produit) : ?>
              <?php if ($produit->getNomCategorie()=='Capillaire') : ?>

                <?php $estEnStock = $produit->getQuantite() > 0; ?>
                <div class="col-sm-6 col-md-4 col-lg-3 mb-4">

                  <?php include 'affichageProduitStore.php' ?>
    
                </div>
              <?php endif; ?>
            <?php endforeach; ?>
          </div>
        </div>

        <!-- Section "Produits Corporels" -->
        <div class="tab-pane fade" id="category3" role="tabpanel" aria-labelledby="categorieCorporelle">
          <div class="row">
            <?php foreach ($produits as $produit) : ?>
              <?php if ($produit->getNomCategorie() == 'Corporelle') : ?>
                <?php $estEnStock = $produit->getQuantite() > 0; ?>
                <div class="col-sm-6 col-md-4 col-lg-3 mb-4">

                  <?php include 'affichageProduitStore.php' ?>
    
                </div>
              <?php endif; ?>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
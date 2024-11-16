<?php
  require_once 'header.php';
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <style>
      .product-card {
        height: 30%;
        width: 70%;
      }
      .product-card img {
        height: 250px; 
        object-fit: cover;
      }
      .product-card .card-body {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
      }
    </style>
    
    <title>Store</title>
</head>

<body>
    <div class="container mt-5">
      <div class="row">
        <div class="col-12 text-center my-4">
          <h1 class="page-title text-success">Store</h1>
          <p class="fs-5 opacity-50"> Boutique pour les ancien(ne)s moches et futur(e)s beaux/belles</p>
        </div>
      </div>
    </div>

    <div class="container my-4">
      <div class="d-grid d-md-flex justify-content-md-end">
        <a class="btn btn-success" href="panier.php"><i class="bi bi-cart3"></i></a>
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
                <div class="col-md-4 mb-4">
                  <div class="card product-card">
                    <img src="<?= !empty($produit['chemin']) ? "../ressources/".$produit['image_chemin'] : '../ressources/images-produit/image-back.png'; ?>" class="card-img-top" alt="Product Image">
                    <div class="card-body">
                      <h5 class="card-title"><?= $produit['nom'].' '.$produit['prix_unitaire'].'$'; ?></h5>
                      <p class="card-text"><?= $produit['courte_description']; ?></p>
                      <a href="detailProduit.php?id=<?= $produit['id_produit']; ?>" class="btn btn-success">Voir Details</a>
                    </div>
                  </div>
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
              <?php if ($produit['nom_categorie'] == 'Capillaire') : ?>
                <div class="col-md-4 mb-4">
                  <div class="card product-card">
                    <img src="<?= !empty($produit['chemin']) ? REPERTOIRE_RESSOURCE.$produit['chemin'] : '../ressources/images-produit/image-back.png'; ?>" class="card-img-top" alt="Product Image">
                    <div class="card-body">
                      <h5 class="card-title"><?= $produit['nom'].' '.$produit['prix_unitaire'].'$'; ?></h5>
                      <p class="card-text"><?= $produit['courte_description']; ?></p>
                      <a href="detailProduit.php?id=<?= $produit['id_produit']; ?>" class="btn btn-success">Voir Details</a>
                    </div>
                  </div>
                </div>
              <?php endif; ?>
            <?php endforeach; ?>
          </div>
        </div>

        <!-- Section "Produits Corporels" -->
        <div class="tab-pane fade" id="category3" role="tabpanel" aria-labelledby="categorieCorporelle">
          <div class="row">
            <?php foreach ($produits as $produit) : ?>
              <?php if ($produit['nom_categorie'] == 'Corporelle') : ?>
                <div class="col-md-4 mb-4">
                  <div class="card product-card">
                    <img src="<?= !empty($produit['chemin']) ? REPERTOIRE_RESSOURCE.$produit['chemin'] : '../ressources/images-produit/image-back.png'; ?>" class="card-img-top" alt="Product Image">
                    <div class="card-body">
                      <h5 class="card-title"><?= $produit['nom'].' '.$produit['prix_unitaire'].'$'; ?></h5>
                      <p class="card-text"><?= $produit['courte_description']; ?></p>
                      <a href="detailProduit.php?id=<?= $produit['id_produit']; ?>" class="btn btn-success">Voir Details</a>
                    </div>
                  </div>
                </div>
              <?php endif; ?>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>

    <!-- Optional JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

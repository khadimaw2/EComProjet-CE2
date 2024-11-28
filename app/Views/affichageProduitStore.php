<!-- Ajout d'une classe CSS pour réduire la clarté si le produit est en rupture -->
<div class="card product-card <?= !$estEnStock ? 'stock-rupture' : ''; ?>">

            <img src="<?= !empty($produit->getcheminImage()) ? "../ressources/".$produit->getcheminImage() : '../ressources/images-produit/image-back.png'; ?>" 
                class="card-img-top" alt="Product Image">
            <div class="card-body">
            <h5 class="card-title">
                <?= $produit->getNom().' '.$produit->getPrixUnitaire().'$'; 
                if (!$estEnStock):  ?> 
                    
                    <span class="badge text-bg-danger">Rupture stock</span>  
                <?php endif; ?>
            </h5>
                <p class="card-text text-truncate" style="max-height: 60px; overflow: hidden;"><?= $produit->getCourteDescription(); ?></p>
                <a href="<?= $estEnStock ? "../publics/details-produit.php?id=" . $produit->getId() : '#'; ?>" 
                    class="btn <?= $estEnStock ? 'btn-success' : 'btn-secondary disabled'; ?> w-100">
                    Voir Details
                </a>
        </div>
</div>
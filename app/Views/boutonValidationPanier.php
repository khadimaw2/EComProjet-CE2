<!-- Bouton pour valider le panier -->
<div class="d-flex justify-content-end mt-4">
    
        <?php if (!isset($_SESSION['utilisateur'])) { ?>
            <a class="btn btn-success me-2" href="connexion.php"> 
                <i class="bi bi-cart-check"></i> Passer la commande  
            </a>

        <?php } elseif ( $_SESSION['utilisateur']->getAdresse()  == "Adresse non disponible") { ?>
            <a class="btn btn-success me-2" href="enregistrement-adress.php">
                 <i class="bi bi-cart-check"></i> Passer la commande  
            </a>
             
        <?php } else { ?>
            <form method="POST" action="../publics/panier.php" class="d-inline">
                <input type="hidden" name="action" value="passer-commande">
                <input type="hidden" name="prix-total" value="<?=$totalAPayer?>">
                <button type="submit" class="btn btn-sm btn-danger" title="Supprimer">
                    <i class="bi bi-cart-check"></i>
                    Passer la commande  
                </button>
            </form>
        <?php }?>
        
</div>
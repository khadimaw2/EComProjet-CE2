<div class="d-flex justify-content-end mt-4">
    <!-- Bouton pour valider le panier -->
    <?php if (!isset($_SESSION['utilisateur'])) { ?>
        <a class="btn btn-success me-2" href="connexion.php"> 
            <i class="bi bi-cart-check"></i> Passer la commande  
        </a>
    <?php } elseif ($_SESSION['utilisateur']->getAdresse() == "Adresse non disponible") { ?>
        <a class="btn btn-success me-2" href="enregistrement-adress.php">
             <i class="bi bi-cart-check"></i> Passer la commande  
        </a>
    <?php } else { ?>


        <!--Sans Paypal-->
        <form method="POST" action="../publics/panier.php" class="d-inline">
            <input type="hidden" name="action" value="passer-commande">
            <input type="hidden" name="prix-total" value=" <?=htmlspecialchars($totalAPayer); ?>">
            <button type="submit" class="btn btn-sm btn-danger" title="Passer la commande">
                <i class="bi bi-cart-check"></i>
                Passer la commande  
            </button>
        </form> 

        <!-- Bouton de paiement PayPal -->
        <div id="paypal-button-container" class="ms-3">            
            
        </div>

    <?php } ?>

    
</div>

<script src="https://www.paypal.com/sdk/js?client-id=AcNkMnoSpQgM2yB4Yy5TN6lZbX-2-mlQfSkffx4E1eDPKsO4WIwh1DcXOcOQLfShOsRp38mXgV-67PyA&components=buttons"></script>
<script>
    paypal.Buttons({
        createOrder: function(data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: '<?= htmlspecialchars($totalAPayer); ?>' 
                    }
                }]
            });
        },
        onApprove: function(data, actions) {
            return actions.order.capture().then(function(details) {

                // formulaire dynamique pour soumettre les données POST
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '../publics/panier.php';

                const actionInput = document.createElement('input');
                actionInput.type = 'hidden';
                actionInput.name = 'action';
                actionInput.value = 'passer-commande';
                form.appendChild(actionInput);

                const prixInput = document.createElement('input');
                prixInput.type = 'hidden';
                prixInput.name = 'prix-total';
                prixInput.value = '<?= htmlspecialchars($totalAPayer); ?>';
                form.appendChild(prixInput);

                // Ajouter le formulaire au document et le soumettre
                document.body.appendChild(form);
                form.submit();
            });
        },
        onError: function(err) {
            alert("Erreur lors du paiement : " + err);
        }
    }).render('#paypal-button-container');
</script>

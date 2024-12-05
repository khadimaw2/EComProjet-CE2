<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$roleConnecte = $_SESSION['utilisateur']->getRole(); 
?>

<tr>
    <th scope="row"><?= $i++; ?></th>
    <td><?= htmlspecialchars($commande->getDate()); ?></td>
    <td><?= htmlspecialchars($utilisateur->getPrenom() . ' ' . $utilisateur->getNom()); ?></td>
    <td><?= htmlspecialchars($utilisateur->getTelephone()); ?></td>
    <td><?= htmlspecialchars($adressClient); ?></td>
    <td>
        <span class="badge <?= $commande->getStatut() == 0 ? 'text-bg-light' : 'text-bg-success'; ?>">
            <?= $commande->getStatut() == 0 ? 'Àlivrer' : 'Livrée'; ?>
        </span>
    </td>
    <td><?= htmlspecialchars($commande->getPrixTotal()) . ' $'; ?></td>
    <td class="text-center">
        <!-- Bouton Voir les détails -->
        <a class="btn btn-sm btn-info" title="Voir les détails" 
           href="details-commande.php?id=<?= $commande->getIdCommande(); ?>">
            <i class="bi bi-eye"></i>
        </a>

        <!-- Bouton Valider Livraison -->
        <form method="POST" action="../publics/toutes-les-commandes.php" class="d-inline" 
              onsubmit="return confirm('Êtes-vous sûr de vouloir valider la livraison ?');">
            <input type="hidden" name="action" value="valider-livraison">
            <input type="hidden" name="id" value="<?= $commande->getIdCommande(); ?>">
            <button type="submit" class="btn btn-sm btn-success" title="Valider la livraison">
                <i class="bi bi-check-circle"></i> 
            </button>
        </form>

        <!-- Bouton Dévalider Livraison (Réinitialiser) -->
        <form method="POST" action="../publics/toutes-les-commandes.php" class="d-inline" 
              onsubmit="return confirm('Êtes-vous sûr de vouloir annuler la livraison ?');">
            <input type="hidden" name="action" value="reinitialiser-livraison">
            <input type="hidden" name="id" value="<?= $commande->getIdCommande(); ?>">
            <button type="submit" class="btn btn-sm btn-warning" title="Annuler la livraison"
                <?= $roleConnecte !== 'admin' ? 'disabled' : ''; ?>>
                <i class="bi bi-arrow-counterclockwise"></i> 
            </button>
        </form>

        <!-- Bouton Supprimer (uniquement pour l'admin) -->
        <form method="POST" action="../publics/toutes-les-commandes.php" class="d-inline" 
              onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette commande ?');">
            <input type="hidden" name="action" value="supprimer">
            <input type="hidden" name="id" value="<?= $commande->getIdCommande(); ?>">
            <button type="submit" class="btn btn-sm btn-danger" title="Supprimer" 
                    <?= $roleConnecte !== 'admin' ? 'disabled' : ''; ?>>
                <i class="bi bi-trash"></i>
            </button>
        </form>
    </td>
</tr>

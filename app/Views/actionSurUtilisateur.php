<?php
// Supposons que le rôle de l'utilisateur connecté soit stocké dans $_SESSION['role']
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$roleConnecte = $_SESSION['utilisateur']->getRole(); // Rôle de l'utilisateur connecté
?>

<!-- Modifier rôle -->
<?php if ($roleConnecte === 'admin'): ?>
    <form method="POST" action="../publics/liste-utilisateurs.php" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir changer le rôle de cet utilisateur ?');">
        <input type="hidden" name="action" value="modifier-role">
        <input type="hidden" name="id" value="<?= $utilisateur->getId(); ?>">
        <input type="hidden" name="actuelRole" value="<?= $utilisateur->getRole(); ?>">
        
        <button type="submit" class="btn btn-sm btn-info" title="Changer rôle"
            <?= $utilisateur->getRole() === 'admin' ? 'disabled' : ''; ?>>
            <i class="bi bi-arrow-repeat"></i> 
            <?= $utilisateur->getRole() === 'client' ? 'Empl' : 'Client'; ?>
        </button>
    </form>
<?php endif; ?>

<!-- Supprimer -->
<?php if ($roleConnecte === 'admin'): ?>
    <form method="POST" action="../publics/liste-utilisateurs.php" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">
        <input type="hidden" name="action" value="supprimer">
        <input type="hidden" name="id" value="<?= $utilisateur->getId(); ?>">
        
        <button type="submit" class="btn btn-sm btn-danger" title="Supprimer"
            <?= $utilisateur->getRole() === 'admin' ? 'disabled' : ''; ?>>
            <i class="bi bi-trash"></i>
        </button>
    </form>
<?php endif; ?>

<!-- Si l'utilisateur connecté est un employé, désactiver les boutons -->
<?php if ($roleConnecte === 'employer'): ?>
    <button class="btn btn-sm btn-info" title="Changer rôle" disabled>
        <i class="bi bi-arrow-repeat"></i> rôle
    </button>
    <button class="btn btn-sm btn-danger" title="Supprimer" disabled>
        <i class="bi bi-trash"></i> 
    </button>
<?php endif; ?>

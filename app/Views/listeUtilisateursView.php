<?php
require_once 'header.php';
?>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 text-center my-4">
                <h1 class="page-title text-success">Gestion des utilisateurs</h1>
            </div>
        </div>

        <?php if (!empty($utilisateurs)) { ?>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Prenom</th>
                    <th scope="col">Courriel</th>
                    <th scope="col">Role</th>
                    <th scope="col">Adresse</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $i = 1;
                foreach ($utilisateurs as $utilisateur) { ?>
                    <tr>
                        <th scope="row"><?= $i++; ?></th>
                        <td><?= htmlspecialchars($utilisateur->getNom()); ?></td>
                        <td><?= htmlspecialchars($utilisateur->getPrenom()); ?></td>
                        <td><?= htmlspecialchars($utilisateur->getCourriel()); ?></td>
                        <td><?= htmlspecialchars($utilisateur->getRole()); ?></td>
                        <td><?= htmlspecialchars($utilisateur->getAdresse()); ?></td>
                        <td>
                            <!-- Formulaire pour changer le rôle de l'utilisateur -->
                            <form method="POST" action="../publics/liste-utilisateurs.php" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir changer le rôle de cet utilisateur ?');">
                                <input type="hidden" name="action" value="modifier-role">
                                <input type="hidden" name="id" value="<?= $utilisateur->getId(); ?>">
                                <button type="submit" class="btn btn-info">
                                    <?= $utilisateur->getRole() === 'client' ? 'Passer à admin' : 'Passer à client'; ?>
                                </button>
                            </form>

                            <!-- Formulaire pour supprimer l'utilisateur avec confirmation -->
                            <form method="POST" action="../publics/liste-utilisateurs.php" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">
                                <input type="hidden" name="action" value="supprimer">
                                <input type="hidden" name="id" value="<?= $utilisateur->getId(); ?>">
                                <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <div class="row">
                <div class="col-12 text-center my-4">
                    <h2 class="text-warning">Aucun utilisateur inscrit</h2>
                </div>
            </div>
        <?php } ?>
    </div>
</body>
</html>

<?php
require_once 'header.php';
?>
<body>
    <div class="container mt-5">
        <!-- Titre principal -->
        <div class="row">
            <div class="col-12 text-center my-4">
                <h1 class="page-title text-success">Gestion des utilisateurs</h1>
            </div>
        </div>

        <!-- Vérification si des utilisateurs existent -->
        <?php if (!empty($utilisateurs)) { ?>
            <div class="card shadow">
                <div class="card-header --bs-tertiary-color --bs-tertiary-color-rgb text-white">
                    <h5 class="mb-0">Liste des utilisateurs</h5>
                </div>
                <div class="card-body">
                    <!-- Tableau des utilisateurs -->
                    <table class="table table-striped table-hover table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nom</th>
                                <th scope="col">Prénom</th>
                                <th scope="col">Courriel</th>
                                <th scope="col">Rôle</th>
                                <th scope="col">Adresse</th>
                                <th scope="col" class="text-center">Actions</th>
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
                                    <td>
                                        <span class="badge bg-<?= $utilisateur->getRole() === 'admin' ? 'success' : 'secondary'; ?>">
                                            <?= htmlspecialchars($utilisateur->getRole()); ?>
                                        </span>
                                    </td>
                                    <td><?= htmlspecialchars($utilisateur->getAdresse()); ?></td>
                                    <td class="text-center">
                                        <!-- Bouton groupe pour actions -->
                                        <div class="btn-group" role="group">
                                            <!-- Modifier rôle -->
                                            <form method="POST" action="../publics/liste-utilisateurs.php" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir changer le rôle de cet utilisateur ?');">
                                                <input type="hidden" name="action" value="modifier-role">
                                                <input type="hidden" name="id" value="<?= $utilisateur->getId(); ?>">
                                                <input type="hidden" name="actuelRole" value="<?= $utilisateur->getRole(); ?>">
                                                <button type="submit" class="btn btn-sm btn-info" title="Changer rôle">
                                                    <i class="bi bi-arrow-repeat"></i> <?= $utilisateur->getRole() === 'client' ? 'Admin' : 'Client'; ?>
                                                </button>
                                            </form>
                                            <!-- Supprimer -->
                                            <form method="POST" action="../publics/liste-utilisateurs.php" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">
                                                <input type="hidden" name="action" value="supprimer">
                                                <input type="hidden" name="id" value="<?= $utilisateur->getId(); ?>">
                                                <button type="submit" class="btn btn-sm btn-danger" title="Supprimer">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php } else { ?>
            <!-- Message quand aucun utilisateur n'est trouvé -->
            <div class="row">
                <div class="col-12 text-center my-5">
                    <div class="alert alert-warning" role="alert">
                        <i class="bi bi-info-circle-fill"></i> Aucun utilisateur inscrit pour le moment.
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</body>
</html>

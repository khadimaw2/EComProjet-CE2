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
                                        
                                    <span class="badge 
                                        <?php 
                                            if ($utilisateur->getRole() === 'admin') {
                                                echo 'bg-warning text-dark'; // Gold pour Admin
                                            } elseif ($utilisateur->getRole() === 'employer') {
                                                echo 'bg-info'; // Vert pour Employer
                                            } else {
                                                echo 'bg-secondary'; // Gris pour Client
                                            }
                                        ?>">
                                        <?= htmlspecialchars($utilisateur->getRole()); ?>
                                    </span>


                                    </td>
                                    <td><?= htmlspecialchars($utilisateur->getAdresse()); ?></td>
                                    <td class="text-center">
                                        <!-- Bouton groupe pour actions -->
                                        <div class="btn-group" role="group">
                                            <?php include 'actionSurUtilisateur.php' ?> 
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

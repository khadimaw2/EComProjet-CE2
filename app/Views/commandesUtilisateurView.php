<?php
require_once 'header.php';

use App\Models\Commande;
use App\Models\Utilisateur;
use App\Services\AdressService;
use App\Services\CommandeService;
use App\Services\UtilisateurService;

$adressService = new AdressService();
$utilisateurService = new UtilisateurService();
?>
<body>
    <div class="container mt-5">
        <!-- Titre principal -->
        <div class="row">
            <div class="col-12 text-center my-4">
                <h1 class="page-title text-success fw-bold">Mes commandes</h1>
            </div>
        </div>
        <?php if (!empty($commandes)) { ?>
            <!-- Onglet Toutes les commandes -->
            <div class="tab-pane fade show active" id="toutesLesCommandes" role="tabpanel" aria-labelledby="toutesLesCommandes-tab">
                <div class="card shadow">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0">Liste des commandes</h5>
                    </div>
                    <div class="card-body">
                        <!-- Tableau des commandes -->
                        <table class="table table-striped table-hover table-bordered align-middle">
                            <thead class="table-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Date et heure</th>
                                <th scope="col">Quantite</th>
                                <th scope="col">Adresse de Livraison</th>
                                <th scope="col">P. total</th>
                                <th scope="col">Statut</th>
                                <th scope="col" class="text-center">Actions</th>
                            </tr>
                            </thead>

                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($commandes as $commande) { 
                                    $adressClient = $adressService->recupererChaineAdressUtilisateur($commande->getIdUtilisateur());
                                    ?>
                                
                                    <tr>
                                        <th scope="row"><?= $i++; ?></th>
                                        <td><?= htmlspecialchars($commande->getDate()); ?></td>
                                        <td><?= htmlspecialchars($commande->getQuantite()); ?></td>
                                        <td><?= htmlspecialchars($adressClient); ?></td>
                                        <td><?= htmlspecialchars($commande->getPrixTotal().'$'); ?></td>
                                        <td>
                                            <span class="badge <?= $commande->getStatut() == 0 ? 'text-bg-light' : 'text-bg-success'; ?>">
                                                <?= $commande->getStatut() == 0 ? 'En cours' : 'Livrée'; ?>
                                            </span>
                                        </td>

                                        <td class="text-center">
                                            <a class="btn btn-sm btn-info" title="Voir les détails" 
                                            href="details-commande.php?id=<?= $commande->getIdCommande(); ?>">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php } else { ?>
            <!-- Message si aucune commande n'est trouvée -->
            <div class="row">
                <div class="row justify-content-center">
                    <div class="col-md-6 col-sm-12">
                        <div class="alert alert-warning" role="alert">
                            <i class="bi bi-info-circle-fill"></i> 
                            Faites un tour dans le Store. Et passez votre premiere commande !
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</body>
</html>

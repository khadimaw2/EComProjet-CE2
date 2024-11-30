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
                <h1 class="page-title text-success fw-bold">Gestion des commandes</h1>
            </div>
        </div>

        <?php if (!empty($commandes)) { ?>
            <!-- Onglets de navigation -->
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link text-success active" id="toutesLesCommandes-tab" data-bs-toggle="tab" 
                    href="#toutesLesCommandes" role="tab" aria-controls="toutesLesCommandes" aria-selected="true">Toutes</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link text-success" id="alivrer-tab" data-bs-toggle="tab" 
                    href="#alivrer" role="tab" aria-controls="alivrer" aria-selected="false">À livrer</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link text-success" id="dejaLivrees-tab" data-bs-toggle="tab" 
                    href="#dejaLivrees" role="tab" aria-controls="dejaLivrees" aria-selected="false">Déjà Livrées</a>
                </li>
            </ul>

            <!-- Contenu des onglets -->
            <div class="tab-content mt-4">

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
                                    <?php include 'commandeTheadTr.php'?>
                                </thead>

                                <tbody>
                                    <?php
                                        CommandeService::afficherCommandes($commandes, $utilisateurService, $adressService, null,true);
                                    ?>
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>

                <!--onglets À livrer  -->
                <div class="tab-pane fade" id="alivrer" role="tabpanel" aria-labelledby="alivrer-tab">
                    <div class="card shadow">
                        <div class="card-header bg-success  text-white">
                            <h5 class="mb-0">Liste des commandes</h5>
                        </div>
                        <div class="card-body">
                        <table class="table table-striped table-hover table-bordered align-middle">
                            <thead class="table-dark">
                                <?php include 'commandeTheadTr.php'?>
                            </thead>

                            <tbody>
                            <?php
                                CommandeService::afficherCommandes($commandes, $utilisateurService, $adressService, 0,false)
                            ?>
                            </tbody>
                        </table>   
                        </div>
                    </div>
                </div>


                <!--onglets Deja Livree  -->
                <div class="tab-pane fade" id="dejaLivrees" role="tabpanel" aria-labelledby="dejaLivrees-tab">
                    <div class="card shadow">
                        <div class="card-header bg-success  text-white">
                            <h5 class="mb-0">Liste des commandes</h5>
                        </div>
                        <div class="card-body">
                        <table class="table table-striped table-hover table-bordered align-middle">
                            <thead class="table-dark">
                                <?php include 'commandeTheadTr.php'?>
                            </thead>

                            <tbody>
                            <?php
                                CommandeService::afficherCommandes($commandes, $utilisateurService, $adressService, 1,false);
                            ?>                          
                        </table>   
                        </div>
                    </div>
                </div>
            </div>
        <?php } else { ?>
            <!-- Message si aucune commande n'est trouvée -->
            <div class="row">
                <div class="col-12 text-center my-5">
                    <div class="alert alert-warning" role="alert">
                        <i class="bi bi-info-circle-fill"></i> Aucune commande trouvée.
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</body>
</html>

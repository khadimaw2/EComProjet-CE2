<?php 
   require_once __DIR__ . '/../vendor/autoload.php';
   use App\Controllers\listeUtilisateursController;
   use App\Models\Utilisateur;
   use App\Services\GestionnaireErreur;
   use App\Controllers\ToutesLesCommandesController;
   use App\Models\Adresse;
   use App\Services\RedirectionPage;

   RedirectionPage::redirigerClientStore();

   $toutesLesCommandesController = new ToutesLesCommandesController();

   $toutesLesCommandesController->afficherTouteLesCommandes();

?>
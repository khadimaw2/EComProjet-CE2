<?php 
   require_once __DIR__ . '/../vendor/autoload.php';

   use App\Controllers\ListeProduitsController;
   use App\Models\Produit;

   $listeProduitsController = new ListeProduitsController(); 

   $listeProduitsController->afficherListeProduits();
?>
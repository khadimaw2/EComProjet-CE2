<?php 
   require_once __DIR__ . '/../vendor/autoload.php';

   use App\Controllers\StoreController;
   use App\Models\Produit;

   $storeController = new StoreController(); 

   if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['recherche'])) {
      $storeController->rechercheProduit($_POST['recherche']);
   }else {
      $storeController->afficherStore();
   }

?>
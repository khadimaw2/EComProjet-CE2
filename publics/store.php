<?php 
   require_once __DIR__ . '/../vendor/autoload.php';

   use App\Controllers\StoreController;
   use App\Models\Produit;

   $storeController = new StoreController(); 

   $storeController->afficherStore();
?>
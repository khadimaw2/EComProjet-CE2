<?php 
   require_once __DIR__ . '/../vendor/autoload.php';

   use App\Controllers\StoreController;

   $storeController = new StoreController(); 

   $storeController->afficherStore();
?>
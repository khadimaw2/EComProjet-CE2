<?php
    require_once __DIR__ . '/../../vendor/autoload.php';
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    use App\Controllers\InscriptionController;
    use App\Services\UtilisateurService ;
    $utilisateurService = new UtilisateurService();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>BeautyStore</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    </head>

    <body data-bs-theme="dark">
        <?php include __DIR__ . '/navbar.php' ; ?>
        <?php if(isset($_SESSION['utilisateur']))  include __DIR__ . '/offcanvas-body.php' ; ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>

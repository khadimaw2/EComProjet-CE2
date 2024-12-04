<?php
    require_once __DIR__ . '/../vendor/autoload.php';
    use App\Services\GestionnaireErreur;
    use App\Controllers\MdpOublieController;
    use App\Services\UtilisateurService;

    $utilisateurService = new UtilisateurService();
    $mdpOublieController = new MdpOublieController() ;
    
    //Rediriger vers la store si l'utilisateur est connecte
    if(isset($_SESSION['utilisateur'])){
        header("Location: store.php");
        exit;
    }
    try {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $mdpOublieController->modiferMdp($_POST);
        }else {
            
            empty($_GET['token']) || !isset($_GET['token']) ? 
            throw new Exception('Jeton de renetialisation absent')
            :null;

            $token = $_GET['token'];
            $email = $utilisateurService->validerToken( $token );

            if (!$email) {
                throw new Exception('Jeton de renetialisation invalide');
            }

            $mdpOublieController->afficherFormulaireMdpOublie($errors=[], $values=[], $email);
        }
    } catch (Exception $e) {
        GestionnaireErreur::redirigerVersErreurPage($e->getMessage());
    }

    


?>
<?php 
namespace App\Services;

class GestionnaireErreur
{
    //Redirige vers une page d'affichage du message d'erreur
    public static function redirigerVersErreurPage($message = 'Erreur inconnue'){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['error_message'] = $message;
        header("Location: ../app/Views/erreur.php");
        exit();
    }   
}
?>
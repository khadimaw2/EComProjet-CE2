<?php 
namespace App\Services;

class RedirectionPage
{
    //Redirige vers une page d'affichage du message d'erreur
    public static function redirigerClientStore(){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['utilisateur']) || $_SESSION['utilisateur']->getRole()=='client') {
            header("Location:../publics/store.php");
            exit();
        }  
    }   

    public static function redirrigersVersPage($page){
        header("Location:../publics/".$page);
        exit();
    }
}
?>
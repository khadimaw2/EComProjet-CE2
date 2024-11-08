<?php 
    namespace App\Services ;

    require_once __DIR__ . '/../../config/config.php';
    use PDO ;
    
    class Database {
        private static $instance = null;
        private $connexion;

        //Le constructeur etablie directement une connexion a la bd mais est inaccessible depuis l'exterieur
        private function __construct() {
            $this->connexion = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
        }
        
        //Cette fonction permet de recuperer la connexion a la base de donne sans pour autant creer un objet Database
        public static function recupererConnexion() {
            if (self::$instance === null) {
                self::$instance = new Database();
            }
            return self::$instance->connexion;
        }
    }

?>
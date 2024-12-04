<?php
namespace App\Controllers ;
require_once __DIR__ . '/../../config/config.php';
use App\Models\Utilisateur;
use App\Services\UtilisateurService ; 
use App\Services\ValidateurDeFormulaire ; 
use App\Services\GestionnaireErreur;
use App\Services\RedirectionPage;
use Exception;
use PHPMailer\PHPMailer\SMTP;
use Postmark\PostmarkClient;


session_start();

    class ConnexionController{
        private $utilisateurService ; 

        public function __construct(){
            $this->utilisateurService = new UtilisateurService();
        }
        
        //Affiche la vue du formualaire
        public function afficherFormulaireConnexion($errors = [], $values = [],$message=null){
            include __DIR__.'/../Views/connexionView.php';
        }

        //Verification et validation de la connexion
        public function connexion(array $donneesFormulaire): void {
            try {
                // Validation des données du formulaire
                list($errors, $values) = ValidateurDeFormulaire::validerFormulaireConnexion($donneesFormulaire);
            
                if (empty($errors)) {
                    $authentificationReussie = $this->utilisateurService->authentificationReussie($values['courriel'], $values['mot_de_passe']);
                    
                    if (!$authentificationReussie) {
                        $errors['echecAuth'] = "Le mot de passe ou le courriel est incorrect";
                        $this->afficherFormulaireConnexion($errors, []);
                    } else {
                        $utilisateur = $this->utilisateurService->recupererInfosUtilisateur($values['courriel']); 
                        $utilisateur->setMotDePasse('');
                        $_SESSION['utilisateur'] = $utilisateur;
                        ValidateurDeFormulaire::unsetSessionVariables(['errors','values']);
                        RedirectionPage::redirrigersVersPage('store.php');
                        exit;
                    }
                }else {
                    // Stocke erreurs et valeurs pour ré-affichage
                    $_SESSION['errors'] = $errors;
                    $_SESSION['values'] = $values;
                    $this->afficherFormulaireConnexion($errors, $values);
                }
            } catch (Exception $e) {
                GestionnaireErreur::redirigerVersErreurPage($e->getMessage());
            }
            
        }


        public function verifierDemande($donneesFormulaire){
            try {
                $errors = ValidateurDeFormulaire::verifierFormDemandeRenetialisation($donneesFormulaire);
            
                if (empty($errors)) {
                    $courriel = $donneesFormulaire['courriel'];
                    $lien = $this->genererLienRenetialiation($courriel);
                    $this->envoieEmail($courriel, $lien);
                    $message = 'Un email a ete envoye dans votre courriel, accedez y pour changer votre mdp';
                    $_SESSION['message-confirmation-mail'] = $message;
                    $this->afficherFormulaireConnexion($errors=[], $values=[],$message);
                }else {
                    $_SESSION['errors'] = $errors;
                    $this->afficherFormulaireConnexion($errors);

                }
            } catch (Exception $e) {
                GestionnaireErreur::redirigerVersErreurPage($e->getMessage());
            }
        }


        //Genere un lien temporaire
        private function genererLienRenetialiation($email){
            try {
                $token = $this->utilisateurService->genererTokenReinitialisation($email);
                $lien= "http://localhost/dashboard/EComProjet-CE2/publics/mdp-oublie.php?token={$token}";
                return $lien ; 

            } catch (Exception $e) {
                GestionnaireErreur::redirigerVersErreurPage($e->getMessage());
            }
        }

        // Fonction d'envoie d'email 
        private function envoieEmail($emailDestinataire, $lien){
            require_once __DIR__ . '/../../vendor/autoload.php'; // Inclure l'autoloader Composer si nécessaire

            $mail = new \PHPMailer\PHPMailer\PHPMailer(true);

            try {
                // Configuration du serveur SMTP
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';  
                $mail->SMTPAuth = true;
                $mail->Username = SMTP_USER;
                $mail->Password = SMTP_PASSWORD;         
                 
                $mail->SMTPSecure = \PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                // Destinataires
                $mail->setFrom('aidebeautystore5@gmail.com', 'supportbeautystore'); 
                $mail->addAddress($emailDestinataire); 

                // Contenu de l'e-mail
                $mail->isHTML(true);
                $mail->Subject = 'Reinitialisation de votre mot de passe';
                $mail->Body = "
                                <p>Bonjour,</p>
                                <p>Veuillez cliquer sur le lien suivant pour réinitialiser votre mot de passe :</p>
                                <p><a href='$lien'>$lien</a></p>
                                <p><strong>Attention :</strong> Ce lien expirera dans 10 minutes.</p>
                                <p>Cordialement,<br>L'équipe de support BeautyStore</p>
                                <p>Cordialement,<br>Ne pas repondre</p>
                            ";

                $mail->AltBody = "Bonjour,\n\nVeuillez cliquer sur le lien suivant pour réinitialiser votre mot de passe : $lien\n\nCe lien expirera dans une heure.";

                $mail->send();
            } catch (\PHPMailer\PHPMailer\Exception $e) {
                throw new Exception("L'e-mail n'a pas pu être envoyé. Erreur : " . $mail->ErrorInfo);
            }
        }
    
        //Deconnexion de l'utilisateur
        public function deconnexion(): void {
            unset($_SESSION['utilisateur']);
        }


        
    }
?>
<?php
require '../includes/phpmailer/src/PHPMailer.php';
require '../includes/phpmailer/src/SMTP.php';
require '../includes/phpmailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Vérifie si les données du formulaire ont été soumises
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Création d'une instance de PHPMailer
    $mail = new PHPMailer(true); // true active la gestion des exceptions

    try {
        // Configuration SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp-ecole-gest.alwaysdata.net';
        $mail->Port = 587; // Utilisez le port SMTP approprié fourni par votre hébergeur
        $mail->SMTPAuth = true;
        $mail->Username = 'ecole-gest@alwaysdata.net'; // Utilisation de l'adresse e-mail souhaitée comme expéditeur
        $mail->Password = '76763170'; // Mot de passe de l'adresse e-mail

        // Paramètres de l'e-mail
        $mail->setFrom('ecole-gest@alwaysdata.net', 'Ecole-Gest'); // Adresse de l'expéditeur (utilisation de l'adresse e-mail souhaitée)
        $mail->addAddress($_POST['destinataire']); // Adresse du destinataire (utilisation de l'adresse saisie dans le formulaire)
        $mail->Subject = 'Sujet de l\'e-mail';
        $mail->Body = $_POST['message']; // Contenu de l'e-mail (utilisation du message saisi dans le formulaire)

        // Envoi de l'e-mail
        $mail->send();

        // Alerte JavaScript
        echo '<script>alert("E-mail envoyé avec succès!"); window.location.href = "email_provi.php";</script>';
    } catch (Exception $e) {
        echo 'Erreur lors de l\'envoi de l\'e-mail: ' . $e->getMessage();
    }
} else {
    // Afficher un message si les données du formulaire ne sont pas soumises
    echo 'Erreur: Aucune donnée de formulaire soumise.';
}
?>

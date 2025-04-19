<?php
include '../includes/connection.php';

// Vérifier si les données du formulaire sont soumises
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $destinataire_id = $_POST['destinataire_id'];
    $envoyeur = $_POST['envoyeur'];
    $nom_destinataire = $_POST['nom_destinataire'];
    $prenom_destinataire = $_POST['prenom_destinataire'];
    $poste_envoyeur = $_POST['poste_envoyeur'];
    $message = mysqli_real_escape_string($db, $_POST['message']);

    // Préparer la requête SQL pour insérer le message dans la base de données
    $sql = "INSERT INTO messages (destinataire_id, envoyeur, nom_destinataire, prenom_destinataire, poste_envoyeur, message) 
            VALUES ('$destinataire_id', '$envoyeur', '$nom_destinataire', '$prenom_destinataire', '$poste_envoyeur', '$message')";

    // Exécuter la requête SQL
    if (mysqli_query($db, $sql)) {
        // Message envoyé avec succès
        echo '<script>alert("Message envoyé avec succès."); setTimeout(function(){ window.location.href = "parent_eleve_surv.php"; }, 1000);</script>';
    } else {
        // Erreur lors de l'envoi du message
        echo '<script>alert("Erreur lors de l\'envoi du message: ' . mysqli_error($db) . '");</script>';
    }
} else {
    // Redirection si le formulaire n'est pas soumis
    header("Location: index_syrv.php");
}
?>

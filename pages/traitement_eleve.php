<?php
// Connexion à la base de données
$mysqli = new mysqli("localhost", "root", "", "ecole-gest");

// Vérifier la connexion
if ($mysqli->connect_error) {
    die("Échec de la connexion à la base de données: " . $mysqli->connect_error);
}

// Récupérer les données du formulaire
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$classe = $_POST['classe'];
$annee = $_POST['annee'];
$photo_chemin = "photos/" . basename($_FILES['photo']['name']);

// Déplacer la photo vers le dossier de destination
move_uploaded_file($_FILES['photo']['tmp_name'], $photo_chemin);

// Préparer et exécuter la requête d'insertion
$stmt = $mysqli->prepare("INSERT INTO eleves (nom, prenom, photo, classe, annee_scolaire) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $nom, $prenom, $photo_chemin, $classe, $annee);

if ($stmt->execute()) {
    // Profil de l'élève créé avec succès
    echo "<script>alert('Profil de l\'élève créé avec succès.'); window.location.href = 'profil_eleve.php';</script>";
} else {
    // Erreur lors de la création du profil de l'élève
    echo "<script>alert('Erreur lors de la création du profil de l\'élève: " . $stmt->error . "');</script>";
}

// Fermer la connexion et la requête préparée
$stmt->close();
$mysqli->close();
?>

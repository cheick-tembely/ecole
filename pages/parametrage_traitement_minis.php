<?php

// Connexion à la base de données (à personnaliser avec vos paramètres)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ecole-gest";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("La connexion a échoué : " . $conn->connect_error);
}

// Vérifier si des données ont été soumises
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $academie = $_POST["academie"];
    $nom_ecole = $_POST["nom_ecole"];
    $lieu = $_POST["lieu"];
    $statut = $_POST["statut"];
    $antenne = isset($_POST["antenne"]) ? $_POST["antenne"] : "";
    $date_licence = $_POST["date_licence"];
    // Traitement du logo s'il a été soumis
    if ($_FILES["logo"]["error"] == 0) {
        $upload_dir = "uploads/"; // Répertoire de téléchargement
        $logo_path = $upload_dir . basename($_FILES["logo"]["name"]);
        move_uploaded_file($_FILES["logo"]["tmp_name"], $logo_path);
    }

    // Préparer et exécuter la requête d'insertion dans la table ecole
    $sql = "INSERT INTO ecole (nom,prenom,academie, nom_ecole, logo_path, lieu, statut, antenne,date_licence) 
            VALUES ('$nom','$prenom','$academie', '$nom_ecole', '$logo_path', '$lieu', '$statut', '$antenne', '$date_licence')";

if ($conn->query($sql) === TRUE) {
    echo "Enregistrement des données réussi.";
    // Redirection vers index.php après 2 secondes
    header("refresh:2; url=index_minis.php");
    exit(); // Assurez-vous de quitter le script après la redirection
} else {
    echo "Erreur lors de l'enregistrement des données : " . $conn->error;
}
}

// Fermer la connexion à la base de données
$conn->close();
?>

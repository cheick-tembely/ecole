<?php
// Connexion à la base de données (à personnaliser avec vos paramètres)
$servername = "mysql-ecole-gest.alwaysdata.net";
$username = "350122_db";
$password = "76763170";
$dbname = "ecole-gest_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("La connexion a échoué : " . $conn->connect_error);
}

// Vérifier si des données ont été soumises
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $academie = $_POST["academie"];
    $nom_ecole = $_POST["nom_ecole"];
    $lieu = $_POST["lieu"];
    $statut = $_POST["statut"];
    $antenne = isset($_POST["antenne"]) ? $_POST["antenne"] : "";

    // Traitement du logo s'il a été soumis
    if ($_FILES["logo"]["error"] == 0) {
        $upload_dir = "uploads/"; // Répertoire de téléchargement
        $logo_path = $upload_dir . basename($_FILES["logo"]["name"]);
        move_uploaded_file($_FILES["logo"]["tmp_name"], $logo_path);
    }

    // Préparer et exécuter la requête d'insertion dans la table ecole
    $sql = "INSERT INTO ecole (academie, nom_ecole, logo_path, lieu, statut, antenne) 
            VALUES ('$academie', '$nom_ecole', '$logo_path', '$lieu', '$statut', '$antenne')";

if ($conn->query($sql) === TRUE) {
    echo "Enregistrement des données réussi.";
    // Redirection vers index.php après 2 secondes
    
    exit(); // Assurez-vous de quitter le script après la redirection
} else {
    echo "Erreur lors de l'enregistrement des données : " . $conn->error;
}
}

// Fermer la connexion à la base de données
$conn->close();
?>

<?php
include 'connection.php'; // Connexion à la base de données

function checkLicense($conn) {
    $sql = "SELECT date_licence FROM ecole ORDER BY id DESC LIMIT 1";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $date_licence = $row["date_licence"];
        $current_date = date("Y-m-d");

        if ($current_date > $date_licence) {
            // Redirection vers la page de licence expirée
            header("Location: licence_expired.php");
            exit();
        }
    } else {
        // Si aucune licence n'est définie, rediriger également
        header("Location: licence_expired.php");
        exit();
    }
}


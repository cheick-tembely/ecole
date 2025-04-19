<?php
include '../includes/connection.php'; // Inclure le fichier de connexion

if (isset($_POST['reset_data'])) {
    if (!empty($_POST['tables'])) {
        $tables = $_POST['tables'];
        foreach ($tables as $table) {
            $sql_update = "UPDATE $table SET champ_visible = 0";
            if (mysqli_query($db, $sql_update)) {
                echo "Données réinitialisées avec succès dans la table $table.<br>";
            } else {
                echo "Erreur lors de la réinitialisation des données dans la table $table : " . mysqli_error($db) . "<br>";
            }
        }
    } else {
        echo "Veuillez sélectionner au moins une table à réinitialiser.";
    }
}
?>

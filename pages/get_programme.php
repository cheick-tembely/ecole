<?php
include '../includes/connection.php'; // Assurez-vous d'inclure votre fichier de connexion à la base de données

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['classe_id'])) {
    $classe_id = $_POST['classe_id'];

    // Préparez la requête SQL pour récupérer les programmes de la classe sélectionnée
    $sql = "SELECT id_programme, contenu FROM programme WHERE id_classe = ? ORDER BY id_programme ASC";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("i", $classe_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Créez un tableau pour stocker les données du programme
    $programmes = array();

    // Parcourez les résultats de la requête et ajoutez-les au tableau
    while ($row = $result->fetch_assoc()) {
        $programmes[] = $row;
    }

    // Fermez la requête préparée
    $stmt->close();

    // Retournez les données du programme au format JSON
    echo json_encode($programmes);
} else {
    // Si la classe n'est pas définie ou si la requête n'est pas POST, retournez une réponse vide
    echo json_encode(array());
}
?>

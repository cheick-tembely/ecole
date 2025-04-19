<?php
include '../includes/connection.php';
include '../includes/sidebar_parent.php';

// Supposons que vous ayez une variable de session pour stocker le nom et le prénom du parent
$nom_parent = $_SESSION['nom_user']; // Nom du parent
$prenom_parent = $_SESSION['prenom_user']; // Prénom du parent

// Requête SQL pour sélectionner les messages destinés au parent, triés par date de création décroissante
$sql = "SELECT * FROM messages WHERE nom_destinataire = '$nom_parent' AND prenom_destinataire = '$prenom_parent' and champ_visible=1 ORDER BY date_creation DESC";
$result = mysqli_query($db, $sql);

// Vérifier s'il y a des résultats
if (mysqli_num_rows($result) > 0) {
    // Afficher les messages destinés au parent dans un tableau
    echo '<div class="table-responsive">';
    echo '<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>Envoyé par</th>';
    echo '<th>Poste de l\'envoyeur</th>';
    echo '<th>Message</th>';
    echo '<th>Date de création</th>';
    // Vous pouvez ajouter d'autres colonnes pour afficher plus d'informations sur le message si nécessaire
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    
    // Afficher chaque message dans une nouvelle ligne du tableau
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td>' . $row['envoyeur'] . '</td>';
        echo '<td>' . $row['poste_envoyeur'] . '</td>';
        echo '<td>' . $row['message'] . '</td>';
        echo '<td>' . date('d_m_Y-H:i', strtotime($row['date_creation'])) . '</td>';
        // Vous pouvez ajouter d'autres cellules pour afficher plus d'informations sur le message si nécessaire
        echo '</tr>';
    }
    
    echo '</tbody>';
    echo '</table>';
    echo '</div>';
} else {
    // Aucun message trouvé pour ce parent
    echo "Aucun message trouvé pour ce parent.";
}
?>
<?php
include '../includes/footer.php';
?>

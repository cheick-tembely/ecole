<?php
// Inclure le fichier de connexion à la base de données
include '../includes/connection.php';
include '../includes/sidebar_parent.php';

// Récupérer le nom d'utilisateur du parent connecté depuis la session
$nom_tuteur = $_SESSION['nom_user'];
$prenom_tuteur = $_SESSION['prenom_user'];

// Requête SQL avec une jointure entre les tables 'etudiant' et 'scolarite' pour récupérer les informations de la scolarité de l'élève associé au parent
$query = "SELECT e.nom, e.prenom, e.classe, e.nom_tuteur, e.prenom_tuteur, s.frais_inscription, s.montant_annuel, s.mois_paye
          FROM etudiant e
          JOIN scolarite s ON e.id_etudiant = s.id_etudiant
          WHERE e.nom_tuteur = ? AND e.prenom_tuteur = ? and s.champ_visible=1";
$stmt = $db->prepare($query);

// Vérifier si la préparation de la requête a réussi
if ($stmt) {
    $stmt->bind_param("ss", $nom_tuteur, $prenom_tuteur);
    $stmt->execute();
    $result = $stmt->get_result();

    // Vérifier si des résultats ont été trouvés
    if ($result->num_rows > 0) {
        // Afficher les informations dans un tableau Bootstrap
        echo '<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"> 
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Classe</th>
                        <th>Frais d\'inscription</th>';
        // Vérifier si le montant annuel est supérieur à 0 pour afficher la colonne correspondante
        $row = $result->fetch_assoc();
        if ($row['montant_annuel'] > 0) {
            echo '<th>Montant annuel</th>';
        } else {
            echo '<th>Mois payé</th>';
        }
        echo '</tr>
                </thead>
                <tbody>';
        // Afficher les données pour chaque élève
        $result->data_seek(0); // Revenir au début des résultats pour les parcourir à nouveau
        while ($row = $result->fetch_assoc()) {                         
            echo '<tr>';
            echo '<td>' . $row['nom'] . '</td>';
            echo '<td>' . $row['prenom'] . '</td>';
            echo '<td>' . $row['classe'] . '</td>';
            echo '<td>' . $row['frais_inscription'] . '</td>';
            // Vérifier si le montant annuel est supérieur à 0 pour afficher le montant annuel ou le mois payé
            if ($row['montant_annuel'] > 0) {
                echo '<td>' . $row['montant_annuel'] . '</td>';
            } else {
                echo '<td>' . $row['mois_paye'] . '</td>';
            }
            echo '</tr>';
        }
        echo '</tbody></table>';
    } else {
        echo 'Aucun résultat trouvé.';
    }

    $stmt->close();
} else {
    echo 'Erreur lors de la préparation de la requête.';
}
?>

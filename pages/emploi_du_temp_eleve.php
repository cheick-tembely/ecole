<?php
// Inclusion du fichier de connexion à la base de données
include '../includes/connection.php';
include '../includes/sidebar_eleve.php';

// Vérification si un utilisateur est connecté en tant qu'étudiant
if (isset($_SESSION['MEMBER_ID'])) {
    // Récupération de l'ID de l'étudiant connecté
    $id_etudiant = $_SESSION['nom'];

    // Requête SQL pour récupérer la classe de l'étudiant
    $query_classe_etudiant = "SELECT classe FROM etudiant WHERE nom = $id_etudiant";
    $result_classe_etudiant = mysqli_query($db, $query_classe_etudiant) or die(mysqli_error($db));
    $row_classe_etudiant = mysqli_fetch_assoc($result_classe_etudiant);
    $classe_etudiant = $row_classe_etudiant['classe'];

    // Requête SQL pour récupérer l'emploi du temps de l'étudiant en fonction de sa classe
    $query = "SELECT at.id_emploi, m.id_matiere, m.libelle_matiere, c.id_classe, c.code_classe, at.jour, at.annee_scolaire, at.heure_debut, at.heure_fin  
              FROM emploi at 
              INNER JOIN classe c ON at.id_classe = c.id_classe 
              INNER JOIN matiere m ON at.id_matiere = m.id_matiere 
              WHERE c.code_classe = '$classe_etudiant'";
    $result = mysqli_query($db, $query) or die(mysqli_error($db));

    // Vérification si des emplois du temps ont été trouvés
    if (mysqli_num_rows($result) > 0) {
        // Affichage de l'emploi du temps de l'étudiant
        echo "<div class='card shadow mb-4'>";
        echo "<div class='card-header py-3'>";
        echo "<h4 class='m-2 font-weight-bold text-primary'>Votre emploi du temps</h4>";
        echo "</div>";
        echo "<div class='card-body'>";
        echo "<div class='table-responsive'>";
        echo "<table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>Classe</th>";
        echo "<th>Matière</th>";
        echo "<th>Jour</th>";
        echo "<th>Heure Debut</th>";
        echo "<th>Heure Fin</th>";
        echo "<th>Année Scolaire</th>";
        echo "<th>Action</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['code_classe'] . "</td>";
            echo "<td>" . $row['libelle_matiere'] . "</td>";
            echo "<td>" . $row['jour'] . "</td>";
            echo "<td>" . $row['heure_debut'] . "</td>";
            echo "<td>" . $row['heure_fin'] . "</td>";
            echo "<td>" . $row['annee_scolaire'] . "</td>";
            echo "<td align='right'>";
            echo "<div class='btn-group'>";
            echo "<a type='button' class='btn btn-primary bg-gradient-primary' href='emploi_details.php?id=" . $row['id_emploi'] . "'><i class='fas fa-fw fa-list-alt'></i> Détails</a>";
            echo "<div class='btn-group'>";
            echo "<ul class='dropdown-menu text-center' role='menu'></ul>";
            echo "</div>";
            echo "</div>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
    } else {
        echo "Aucun emploi du temps trouvé pour cet utilisateur.";
    }
}

include '../includes/footer_eleve.php';
?>

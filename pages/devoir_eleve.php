<?php
session_start();
include '../includes/connection.php';
include '../includes/sidebar_eleve.php';

// Supposons que le nom et le prénom de l'étudiant sont stockés dans la session
$nomEtudiant = $_SESSION['nom'];
$prenomEtudiant = $_SESSION['prenom'];

// Requête pour récupérer la classe de l'étudiant depuis la table `etudiant` en utilisant nom et prénom
$queryClasse = "SELECT classe FROM etudiant WHERE nom = '$nomEtudiant' AND prenom = '$prenomEtudiant'";
$resultClasse = mysqli_query($db, $queryClasse) or die(mysqli_error($db));
$rowClasse = mysqli_fetch_assoc($resultClasse);

// Vérifiez si la classe a été trouvée
if ($rowClasse) {
    $classeEtudiant = $rowClasse['classe'];
} else {
    // En cas d'erreur, définissez une valeur par défaut ou affichez un message
    $classeEtudiant = null;
    die("Classe introuvable pour l'étudiant.");
}
?>

<div class="card shadow mb-4 col-md-12">
    <div class="card-header py-3">
        <h4 class="m-2 font-weight-bold text-primary">Devoir à Domicile</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nom Prof</th>
                        <th>Prénom Prof</th>
                        <th>Classe</th>
                        <th>Titre</th>
                        <th>Contenu</th>
                        <th>Date Limite</th>
                    </tr>
                </thead>
                <tbody>
                    <?php                  
                    // Requête pour récupérer uniquement les devoirs de la classe de l'étudiant
                    $query = "SELECT * FROM devoirs_domicile WHERE champ_visible = 1 AND classe = '$classeEtudiant'";
                    $result = mysqli_query($db, $query) or die(mysqli_error($db));

                    // Affichage des résultats
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>';
                        echo '<td>' . $row['nom_prof'] . '</td>';
                        echo '<td>' . $row['prenom_prof'] . '</td>';
                        echo '<td>' . $row['classe'] . '</td>';
                        echo '<td>' . $row['titre_devoir'] . '</td>';
                        echo '<td>' . $row['contenu'] . '</td>';
                        echo '<td>' . $row['date_limite'] . '</td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

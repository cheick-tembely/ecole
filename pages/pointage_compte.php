<?php
include '../includes/connection.php';
include '../includes/sidebar_surv.php';

$query = "SELECT pr.id_professeur, pr.nom_professeur, pr.prenom_professeur, m.libelle_matiere, 
          DATE_FORMAT(p.date_debut, '%Y-%m') AS mois_pointage,
          COUNT(p.id_pointage) AS nombre_pointages
          FROM professeur pr
          LEFT JOIN pointage p ON pr.id_professeur = p.id_professeur
          LEFT JOIN matiere m ON p.id_matiere = m.id_matiere
          GROUP BY pr.id_professeur, mois_pointage and p.nom_ecole = (SELECT nom_ecole FROM utilisateur WHERE nom_user = '".$_SESSION['nom_user']."' AND prenom_user = '".$_SESSION['prenom_user']."') and p.champ_visible=1";

$result = mysqli_query($db, $query) or die(mysqli_error($db));
?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h4 class="m-2 font-weight-bold text-primary">Liste des Professeurs, Leurs Matières, le Mois du Pointage et le Nombre de Leurs Pointages</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nom du Professeur</th>
                        <th>Prénom du Professeur</th>
                        <th>Matière</th>
                        <th>Mois du Pointage</th>
                        <th>Nombre de Pointages</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>';
                        echo '<td>' . $row['nom_professeur'] . '</td>';
                        echo '<td>' . $row['prenom_professeur'] . '</td>';
                        echo '<td>' . $row['libelle_matiere'] . '</td>';
                        echo '<td>' . $row['mois_pointage'] . '</td>';
                        echo '<td>' . $row['nombre_pointages'] . '</td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
include '../includes/footer.php';
?>

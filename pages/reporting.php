<?php
include'../includes/connection.php';
include'../includes/sidebar.php';

// Déterminer le mois actuel
$mois_actuel = date('m');
$annee_actuelle = date('Y');

// Déterminer le mois précédent
if ($mois_actuel == 1) {
    $mois_precedent = 12;
    $annee_precedente = $annee_actuelle - 1;
} else {
    $mois_precedent = $mois_actuel - 1;
    $annee_precedente = $annee_actuelle;
}

// Requête SQL pour sélectionner les professeurs pointés au mois précédent
$query = "SELECT pr.id_professeur, pr.nom_professeur, pr.prenom_professeur 
          FROM professeur pr
          INNER JOIN pointage p ON p.id_professeur = pr.id_professeur 
          WHERE MONTH(p.date_debut) = $mois_precedent AND YEAR(p.date_debut) = $annee_precedente
          GROUP BY pr.id_professeur
          ORDER BY pr.nom_professeur ASC";

$result = mysqli_query($db, $query) or die (mysqli_error($db));
?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h4 class="m-2 font-weight-bold text-primary">Liste des Professeurs pointés au mois précédent</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"> 
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php                  
                    while ($row = mysqli_fetch_assoc($result)) {                         
                        echo '<tr>';
                        echo '<td>'. $row['nom_professeur'].'</td>';
                        echo '<td>'. $row['prenom_professeur'].'</td>';
  
                        echo '<td align="right">
                                <a type="button" class="btn btn-primary bg-gradient-primary" href="reporting_searchfrm.php?action=edit&id='.$row['id_professeur'].'"><i class="fas fa-fw fa-th-list"></i> Fiche</a>
                              </td>';
                        echo '</tr>';
                    }
                    ?> 
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
include'../includes/footer.php';
?>

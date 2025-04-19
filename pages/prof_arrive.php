<?php
include'../includes/connection.php';
include'../includes/sidebar_surv.php';

// Récupérer la date actuelle
$dateActuelle = date('Y-m-d'); // Format de date YYYY-MM-DD

// Vérifier le niveau de l'utilisateur
$query = "SELECT id_user, t.niveau
          FROM utilisateur u
          JOIN niveau t ON t.id_niveau=u.id_niveau
          WHERE id_user = ".$_SESSION['MEMBER_ID'];
$result = mysqli_query($db, $query) or die(mysqli_error($db));

while ($row = mysqli_fetch_assoc($result)) {
    $niveauUtilisateur = $row['niveau'];
    if ($niveauUtilisateur == 'User') {
        echo '<script type="text/javascript">
                  alert("Page restreinte ! Vous serez redirigé vers POS");
                  window.location = "pos.php";
              </script>';
    }
}

?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h4 class="m-2 font-weight-bold text-primary">Liste des Présences des Professeurs (<?php echo $dateActuelle; ?>)</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Date</th>
                        <th>Classe</th>
                        <th>Heure Arrivée</th>
                     
                    </tr>
                </thead>
                <tbody>
                    <?php                  
                  $query = "SELECT * FROM arrivee_professeur WHERE date = '$dateActuelle' AND nom_ecole = (SELECT nom_ecole FROM utilisateur WHERE nom_user = '".$_SESSION['nom_user']."' AND prenom_user = '".$_SESSION['prenom_user']."') ORDER BY id_professeur DESC";
                  $result = mysqli_query($db, $query) or die(mysqli_error($db));
                  
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>';
                        echo '<td>'. $row['nom'].'</td>';
                        echo '<td>'. $row['prenom'].'</td>';
                        echo '<td>'. $row['date'].'</td>';
                        echo '<td>'. $row['classe'].'</td>';
                        echo '<td>'. $row['heure_arrivee'].'</td>';
                      
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

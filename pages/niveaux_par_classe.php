<?php
include '../includes/connection.php';
include '../includes/sidebar_enq.php';

if (isset($_GET['id_classe'])) {
    $classeId = $_GET['id_classe'];

    // Sélectionnez les niveaux d'enseignement de la classe spécifique
    $queryNiveaux = "SELECT * FROM niveau_enseignement WHERE id_classe = $classeId ORDER BY id_niveau DESC";
    $resultNiveaux = mysqli_query($db, $queryNiveaux) or die(mysqli_error($db));

    // Vérifiez s'il y a des niveaux d'enseignement disponibles
    if (mysqli_num_rows($resultNiveaux) > 0) {
        // Affichez les niveaux d'enseignement
        echo '<div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h4 class="m-2 font-weight-bold text-primary">Niveaux d\'Enseignement</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">        
                      <thead>
                        <tr>
                          <th>Nom du Prof</th>
                          <th>Prenom du prof</th>
                          <th>Date</th>
                          <th>Contenu</th>
                          <th>Matiere</th>
                          <th>Classe</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>';

        while ($rowNiveau = mysqli_fetch_assoc($resultNiveaux)) {
            echo '<tr>';
            echo '<td>' . $rowNiveau['nom_prof'] . '</td>';
            echo '<td>' . $rowNiveau['prenom_prof'] . '</td>';
            echo '<td>' . $rowNiveau['dates'] . '</td>';
            echo '<td>' . $rowNiveau['contenu'] . '</td>';
            echo '<td>' . $rowNiveau['matiere'] . '</td>';
            echo '<td>' . $rowNiveau['classe'] . '</td>';
            echo '<td align="right">
                    <div class="btn-group">
                      <a type="button" class="btn btn-primary bg-gradient-primary" href="niveau_admin_searchfrm.php?action=edit&id=' . $rowNiveau['id_niveau'] . '"><i class="fas fa-fw fa-list-alt"></i> Details</a>
                    </div>
                  </td>';
            echo '</tr>';
        }

        echo '</tbody>
              </table>
            </div>
          </div>
        </div>';
    } else {
        // Afficher une alerte s'il n'y a pas de niveaux d'enseignement disponibles
        echo '<div class="alert alert-warning" role="alert">
                Aucun niveau d\'enseignement n\'est disponible pour cette classe.
              </div>';
    }
} 

include '../includes/footer.php';
?>

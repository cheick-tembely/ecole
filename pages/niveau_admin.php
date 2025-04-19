<?php
error_reporting(E_ERROR | E_PARSE); // Désactive les avertissements
include '../includes/connection.php';
include '../includes/sidebar.php';

// Vérifiez si l'utilisateur est connecté
if (isset($_SESSION['nom_user']) && isset($_SESSION['prenom_user'])) {
    $nomUser = $_SESSION['nom_user'];
    $prenomUser = $_SESSION['prenom_user'];

    // Sélectionnez le nom de l'école de l'utilisateur
    $query1 = "SELECT nom_ecole FROM ecole WHERE nom = '$nomUser' AND prenom = '$prenomUser'";
    $result1 = mysqli_query($db, $query1);
    $row = mysqli_fetch_assoc($result1);
    $nomEcole = $row['nom_ecole'];

    // Sélectionnez les niveaux d'enseignement par classe de l'école de l'utilisateur
    $query = "SELECT * FROM niveau_enseignement WHERE nom_ecole = '$nomEcole' AND classe = '".$_POST['classe']."' AND champ_visible = 1 ORDER BY id_niveau DESC";
    $result = mysqli_query($db, $query) or die(mysqli_error($db));

    // Affichez les niveaux d'enseignement de l'école de l'utilisateur par classe
    echo '<div class="card shadow mb-4">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Voir la liste des niveaux d\'enseignements par classe</h4>
            </div>
            <div class="card-body">
              <form method="POST" action="">
                <div class="form-group">
                  <label for="classe">Sélectionnez une classe :</label>
                  <select class="form-control" id="classe" name="classe" onchange="this.form.submit()">
                  <option value="CG">CG</option>
                  <option value="SCIENCE">SCIENCE</option>
                  <option value="SES">SES</option>
                  <option value="LETTRE">LETTRE</option>
                  <option value="TSECO">TSECO</option>
                  <option value="TSS">TSS</option>
                  <option value="TSE">TSE</option>
                  <option value="TSEXP">TSEXP</option>
                  <option value="TLL">TLL</option>
              </select>
              
                </div>
              </form>
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

    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td>' . $row['nom_prof'] . '</td>';
        echo '<td>' . $row['prenom_prof'] . '</td>';
        echo '<td>' . $row['dates'] . '</td>';
        echo '<td>' . $row['contenu'] . '</td>';
        echo '<td>' . $row['matiere'] . '</td>';
        echo '<td>' . $row['classe'] . '</td>';
        echo '<td align="right"> <div class="btn-group">
                              <a type="button" class="btn btn-primary bg-gradient-primary" href="niveau_admin_searchfrm.php?action=edit & id=' . $row['id_niveau'] . '"><i class="fas fa-fw fa-list-alt"></i> Details</a>
                            <div class="btn-group">
                            </div>
                          </div> </td>';
        echo '</tr> ';
    }

    echo '</tbody>
          </table>
        </div>
      </div>
    </div>';
} else {
    // Redirigez vers une page de connexion si l'utilisateur n'est pas connecté
    header("Location: login.php");
    exit();
}

include '../includes/footer.php';
?>
<script type="text/javascript">
    function confirmBlock(id_absence) {
        var confirmBlock = confirm("Voulez-vous vraiment supprimer cette absence ?");
        if (confirmBlock) {
            window.location.href = "absence_del.php?id=" + id_absence;
        }
    }
</script>

<?php
include '../includes/connection.php';
include '../includes/sidebar_prof.php';

// Vérifiez si l'utilisateur est connecté
if (isset($_SESSION['nom_user']) && isset($_SESSION['prenom_user'])) {
    $nomUser = $_SESSION['nom_user'];
    $prenomUser = $_SESSION['prenom_user'];

    // Sélectionnez le nom de l'école de l'utilisateur
    $query1 = "SELECT e.nom_ecole FROM utilisateur u INNER JOIN ecole e ON u.nom_ecole = e.nom_ecole WHERE u.nom_user = '$nomUser' AND u.prenom_user = '$prenomUser'";
    $result1 = mysqli_query($db, $query1);
    $row = mysqli_fetch_assoc($result1);
    $nomEcole = $row['nom_ecole'];

    // Sélectionnez les niveaux d'enseignement de l'école de l'utilisateur
    $query = "SELECT * FROM niveau_enseignement WHERE nom_ecole = '$nomEcole' ORDER BY id_niveau DESC";
    $result = mysqli_query($db, $query) or die(mysqli_error($db));

    // Affichez les niveaux d'enseignement de l'école de l'utilisateur
    echo '<div class="card shadow mb-4">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Enregistrez un niveau d\'enseignement&nbsp;<a href="#" data-toggle="modal" data-target="#absenceModal" type="button" class="btn btn-primary bg-gradient-primary" style="border-radius: 0px;"><i class="fas fa-fw fa-plus"></i></a></h4>
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

    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td>' . $row['nom_prof'] . '</td>';
        echo '<td>' . $row['prenom_prof'] . '</td>';
        echo '<td>' . $row['dates'] . '</td>';
        echo '<td>' . $row['contenu'] . '</td>';
        echo '<td>' . $row['matiere'] . '</td>';
        echo '<td>' . $row['classe'] . '</td>';
        echo '<td align="right">
                <div class="btn-group">
                  <a type="button" class="btn btn-primary bg-gradient-primary" href="niveau_prof_searchfrm.php?action=edit&id=' . $row['id_niveau'] . '"><i class="fas fa-fw fa-list-alt"></i> Details</a>
                </div>
              </td>';
        echo '</tr>';
    }

    echo '</tbody>
          </table>
        </div>
      </div>
    </div>';

    // Formulaire d'ajout de niveau d'enseignement
    echo '<div class="modal fade" id="absenceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="m-2 font-weight-bold text-primary">Enregistrez un niveau d\'enseignement</h4>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form role="form" method="post" action="niveau_transac.php?action=add">
                    <div class="form-group">
                      <input class="form-control" placeholder="Nom Professeur" name="nom_prof" value="' . $nomUser . '" required readonly>
                    </div>
                    <div class="form-group">
                      <input class="form-control" placeholder="Prenom Professeur" name="prenom_prof" value="' . $prenomUser . '" required readonly>
                    </div>
                    <div class="form-group">
                      <input type="datetime-local" class="form-control" placeholder="Date" name="dates" required>
                    </div>
                    <div class="form-group">
                      <input class="form-control" placeholder="Contenu" name="contenu" required>
                    </div>
                    <div class="form-group">
                      <input class="form-control" placeholder="Matiere" name="matiere" required>
                    </div>
                    <div class="form-group">
                      <input class="form-control" placeholder="Classe" name="classe" required>
                    </div>
                    <div class="form-group">
                      <input class="form-control" placeholder="Ecole" name="nom_ecole" value="' . $nomEcole . '" required readonly>
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-success"><i class="fa fa-check fa-fw"></i>Envoyer</button>
                    <button type="reset" class="btn btn-danger"><i class="fa fa-times fa-fw"></i>Effacer</button>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>   
                  </form>  
                </div>
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

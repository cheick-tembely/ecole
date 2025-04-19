<?php
include '../includes/connection.php';
include '../includes/sidebar_provi.php';

// Vérifiez si l'utilisateur est connecté
if (isset($_SESSION['nom_user']) && isset($_SESSION['prenom_user'])) {
    $nomUser = $_SESSION['nom_user'];
    $prenomUser = $_SESSION['prenom_user'];

    // Sélectionnez le nom de l'école de l'utilisateur
    $query1 = "SELECT u.nom_user, u.prenom_user,e.nom_ecole FROM utilisateur u,ecole e WHERE u.nom_user = '$nomUser' AND u.prenom_user = '$prenomUser'and u.nom_ecole=e.nom_ecole";
    $result1 = mysqli_query($db, $query1);
    $row = mysqli_fetch_assoc($result1);
    $nomEcole = $row['nom_ecole'];

    // Sélectionnez les notes des étudiants de l'école de l'utilisateur
    $query = "SELECT e.nom, e.prenom, n.matiere, n.interrogation1, n.interrogation2, n.devoir1, n.devoir2, e.classe, n.total_devoirs, n.mois, c.code_classe, n.nom_ecole
              FROM etudiant e 
              INNER JOIN notes n ON e.id_etudiant = n.id_etudiant 
              INNER JOIN classe c ON c.id_classe = n.id_classe
              WHERE n.nom_ecole = '$nomEcole' and n.champ_visible=1"; // Utilisez le nom de l'école de l'utilisateur dans la clause WHERE
    $result = mysqli_query($db, $query) or die(mysqli_error($db));

    // Affichez les notes des étudiants de l'école de l'utilisateur
    echo '<div class="card shadow mb-4">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Notes des Elèves</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">        
                  <thead>
                      <tr>
                        <th>Classe</th>
                        <th>Matière</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Interrogation 1/10</th>
                        <th>Interrogation 2/10</th>
                        <th>Devoir1</th>
                        <th>Devoir2</th>
                        <th>Total Devoir</th>
                        <th>Mois</th>
                      </tr>
                  </thead>
                  <tbody>';

    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td>' . $row['code_classe'] . '</td>';
        echo '<td>' . $row['matiere'] . '</td>';
        echo '<td>' . $row['nom'] . '</td>';
        echo '<td>' . $row['prenom'] . '</td>';
        echo '<td>' . $row['interrogation1'] . '</td>';
        echo '<td>' . $row['interrogation2'] . '</td>';
        echo '<td>' . $row['devoir1'] . '</td>';
        echo '<td>' . $row['devoir2'] . '</td>';
        echo '<td>' . $row['total_devoirs'] . '</td>';
        echo '<td>' . $row['mois'] . '</td>';
        echo '</tr>';
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

<?php
include '../includes/connection.php';
include '../includes/sidebar_enq.php';

// Vérifiez si l'utilisateur est connecté
if (isset($_SESSION['nom_user']) && isset($_SESSION['prenom_user'])) {
    $nomUser = $_SESSION['nom_user'];
    $prenomUser = $_SESSION['prenom_user'];

    // Sélectionnez le nom de l'école de l'utilisateur
    $query1 = "SELECT e.nom_ecole FROM utilisateur u INNER JOIN ecole e ON u.nom_ecole = e.nom_ecole WHERE u.nom_user = '$nomUser' AND u.prenom_user = '$prenomUser'";
    $result1 = mysqli_query($db, $query1);
    $row = mysqli_fetch_assoc($result1);
    $nomEcole = $row['nom_ecole'];

    // Sélectionnez les classes de l'école de l'utilisateur
    $queryClasses = "SELECT * FROM classe WHERE nom_ecole = '$nomEcole' ORDER BY code_classe ASC";
    $resultClasses = mysqli_query($db, $queryClasses) or die(mysqli_error($db));

    // Affichez les classes
    echo '<div class="card shadow mb-4">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Liste des Classes</h4>
            </div>
            <div class="card-body">
              <ul>';

    while ($rowClass = mysqli_fetch_assoc($resultClasses)) {
        echo '<li><a href="niveaux_par_classe.php?classe_id=' . $rowClass['id_classe'] . '">' . $rowClass['code_classe'] . '</a></li>';
    }

    echo '</ul>
          </div>
        </div>';
} else {
    // Redirigez vers une page de connexion si l'utilisateur n'est pas connecté
    header("Location: login.php");
    exit();
}

include '../includes/footer.php';
?>

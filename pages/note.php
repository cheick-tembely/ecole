<?php
include '../includes/connection.php';
include '../includes/sidebar_prof.php';

// Vérifier si un utilisateur est connecté
if (!isset($_SESSION['MEMBER_ID'])) {
    // Rediriger l'utilisateur s'il n'est pas connecté
    header('Location: login.php');
    exit();
}

// Récupérer le nom et le prénom de l'utilisateur connecté
$id_utilisateur = $_SESSION['MEMBER_ID'];
$query_utilisateur = "SELECT nom_user, prenom_user, nom_ecole FROM utilisateur WHERE id_user = $id_utilisateur";
$result_utilisateur = mysqli_query($db, $query_utilisateur) or die(mysqli_error($db));
$row_utilisateur = mysqli_fetch_assoc($result_utilisateur);

// Vérifier si l'utilisateur existe
if (!$row_utilisateur) {
    $error_message = "Utilisateur introuvable";
} else {
    $nom_utilisateur = $row_utilisateur['nom_user'];
    $prenom_utilisateur = $row_utilisateur['prenom_user'];
    $nom_ecole = $row_utilisateur['nom_ecole'];

    // Récupérer les informations du professeur correspondant à l'utilisateur connecté
    $query_professeur = "SELECT id_professeur FROM professeur WHERE nom_professeur = '$nom_utilisateur' AND prenom_professeur = '$prenom_utilisateur' and nom_ecole = '$nom_ecole'";
    $result_professeur = mysqli_query($db, $query_professeur) or die(mysqli_error($db));
    $row_professeur = mysqli_fetch_assoc($result_professeur);

    // Vérifier si le professeur existe
    if (!$row_professeur) {
        $error_message = "Professeur introuvable";
    } else {
        $id_professeur = $row_professeur['id_professeur'];

        // Récupérer les classes attribuées au professeur connecté
        $query_classes = "SELECT DISTINCT c.id_classe, c.code_classe 
                          FROM attribution a 
                          INNER JOIN classe c ON a.id_classe = c.id_classe 
                          WHERE a.id_professeur = $id_professeur and a.nom_ecole = '$nom_ecole'";
        $result_classes = mysqli_query($db, $query_classes) or die(mysqli_error($db));

        // Initialiser la liste de classes
        $classes_list = array();
        while ($row_classe = mysqli_fetch_assoc($result_classes)) {
            $id_classe = $row_classe['id_classe'];
            $code_classe = $row_classe['code_classe'];
            $classes_list[] = '<a href="etudiants_par_classe1.php?classe_id=' . $id_classe . '">' . $code_classe . '</a>';
        }
    }
}

?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h4 class="m-2 font-weight-bold text-primary">Classes enseignées par <?php echo isset($nom_utilisateur) ? $nom_utilisateur . ' ' . $prenom_utilisateur : "Professeur introuvable"; ?></h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <?php if (!empty($classes_list)) : ?>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Code de classe</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($classes_list as $code_classe) {
                        echo '<tr><td>' . $code_classe . '</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
            <?php else : ?>
            <p>Aucune classe attribuée à ce professeur.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php
include '../includes/footer.php';
?>

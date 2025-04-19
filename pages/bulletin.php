<?php
include '../includes/connection.php';
include '../includes/sidebar_cens.php';

// Requête pour récupérer la liste des classes
$sql_classes = "SELECT DISTINCT libelle_classe, id_classe FROM classe where nom_ecole = (SELECT nom_ecole FROM utilisateur WHERE nom_user = '".$_SESSION['nom_user']."' AND prenom_user = '".$_SESSION['prenom_user']."') ORDER BY id_classe ASC";
$result_classes = mysqli_query($db, $sql_classes) or die(mysqli_error($db));

?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h4 class="m-2 font-weight-bold text-primary">Sélectionnez une Classe</h4>
    </div>
    
    <div class="card-body">
        <div class="list-group">
            <?php
            while ($row_class = mysqli_fetch_assoc($result_classes)) {
                echo '<a href="bulletin_cens.php?class_id=' . $row_class['id_classe'] . '" class="list-group-item list-group-item-action">' . $row_class['libelle_classe'] . '</a>';
            }
            ?>
        </div>
    </div>
</div>

<?php
include '../includes/footer.php';
?>

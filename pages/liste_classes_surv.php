<?php
// Inclure les fichiers de connexion et l'en-tête
include '../includes/connection.php';
include '../includes/sidebar_surv.php';
?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h4 class="m-2 font-weight-bold text-primary">Liste des classes</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Classe</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Récupérer les classes depuis la base de données
                    $query = "SELECT * FROM classe WHERE nom_ecole = (SELECT nom_ecole FROM utilisateur WHERE nom_user = '".$_SESSION['nom_user']."' AND prenom_user = '".$_SESSION['prenom_user']."') and champ_visible=1";
                    $result = mysqli_query($db, $query) or die(mysqli_error($db));

                    // Afficher chaque classe avec un lien pour voir les étudiants
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>';
                        echo '<td><a href="etudiants_par_classe_surv.php?classe_id='.$row['id_classe'].'">'.$row['code_classe'].'</a></td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
// Inclure le pied de page
include '../includes/footer.php';
?>

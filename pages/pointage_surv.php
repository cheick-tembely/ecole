<?php
include '../includes/connection.php';
include '../includes/sidebar_surv.php';

// Activation de l'affichage des erreurs PHP
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Génération du dropdown des classes
$sqlforjob = "SELECT DISTINCT libelle_classe, id_classe FROM classe ORDER BY id_classe ASC";
$result = mysqli_query($db, $sqlforjob) or die ("Bad SQL: $sqlforjob");

$id_classe = "<select class='form-control' name='id_classe' required>
        <option value='' disabled selected hidden>Selectionnez la classe</option>";
while ($row = mysqli_fetch_assoc($result)) {
    $id_classe .= "<option value='" . $row['id_classe'] . "'>" . $row['libelle_classe'] . "</option>";
}
$id_classe .= "</select>";

// Génération du dropdown des matières
$sqlforjob = "SELECT DISTINCT libelle_matiere, id_matiere FROM matiere ORDER BY id_matiere ASC";
$result = mysqli_query($db, $sqlforjob) or die ("Bad SQL: $sqlforjob");

$id_matiere = "<select class='form-control' name='id_matiere' required>
        <option value='' disabled selected hidden>Selectionnez la matiere</option>";
while ($row = mysqli_fetch_assoc($result)) {
    $id_matiere .= "<option value='" . $row['id_matiere'] . "'>" . $row['libelle_matiere'] . "</option>";
}
$id_matiere .= "</select>";

// Génération du dropdown des professeurs
$sqlforjob = "SELECT DISTINCT nom_professeur, prenom_professeur, id_professeur FROM professeur ORDER BY id_professeur ASC";
$result = mysqli_query($db, $sqlforjob) or die ("Bad SQL: $sqlforjob");

$id_professeur = "<select class='form-control' name='id_professeur' required>
        <option value='' disabled selected hidden>Selectionnez le professeur</option>";
while ($row = mysqli_fetch_assoc($result)) {
    $id_professeur .= "<option value='" . $row['id_professeur'] . "'>" . $row['nom_professeur'] . ' ' . $row['prenom_professeur'] . "</option>";
}
$id_professeur .= "</select>";

// Vérification des droits d'accès de l'utilisateur
$query = 'SELECT id_user, t.niveau FROM utilisateur u JOIN niveau t ON t.id_niveau = u.id_niveau WHERE id_user = ' . $_SESSION['MEMBER_ID'];
$result = mysqli_query($db, $query) or die(mysqli_error($db));

while ($row = mysqli_fetch_assoc($result)) {
    $Aa = $row['niveau'];
    if ($Aa == 'User') {
        echo '<script>
                alert("Restricted Page! You will be redirected to POS");
                window.location = "pos.php";
              </script>';
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
    <title>Gestion de Pointage</title>
</head>
<body>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="m-2 font-weight-bold text-primary">Enregistrez une Fiche de Pointage&nbsp;
                <a href="#" data-toggle="modal" data-target="#PointageSurvModal" class="btn btn-primary bg-gradient-primary" style="border-radius: 0px;">
                    <i class="fas fa-fw fa-plus"></i>
                </a>
            </h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Code Classe</th>
                            <th>Matière</th>
                            <th>Début</th>
                            <th>Fin</th>
                            <th>Statut</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT id_pointage, pr.nom_professeur, pr.prenom_professeur, c.code_classe, m.libelle_matiere, date_debut, date_fin, p.statut  
                                  FROM pointage p 
                                  JOIN professeur pr ON p.id_professeur = pr.id_professeur
                                  JOIN matiere m ON p.id_matiere = m.id_matiere
                                  JOIN classe c ON c.id_classe = p.id_classe
                                  WHERE p.nom_ecole = (SELECT nom_ecole FROM utilisateur WHERE nom_user = '" . $_SESSION['nom_user'] . "' AND prenom_user = '" . $_SESSION['prenom_user'] . "') 
                                  AND p.champ_visible = 1";
                        $result = mysqli_query($db, $query) or die(mysqli_error($db));
                        $row_ecole = mysqli_fetch_assoc(mysqli_query($db, 'SELECT nom_ecole FROM utilisateur WHERE nom_user = "' . $_SESSION['nom_user'] . '" AND prenom_user = "' . $_SESSION['prenom_user'] . '"'));
                        $nom_ecole = $row_ecole['nom_ecole'];

                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<tr>';
                            echo '<td>' . $row['nom_professeur'] . '</td>';
                            echo '<td>' . $row['prenom_professeur'] . '</td>';
                            echo '<td>' . $row['code_classe'] . '</td>';
                            echo '<td>' . $row['libelle_matiere'] . '</td>';
                            echo '<td>' . $row['date_debut'] . '</td>';
                            echo '<td>' . $row['date_fin'] . '</td>';
                            echo '<td>' . $row['statut'] . '</td>';
                            echo '<td align="right">
                                    <div class="btn-group">
                                        <a class="btn btn-primary bg-gradient-primary" href="pointage_surv_searchfrm.php?action=edit&id=' . $row['id_pointage'] . '">
                                            <i class="fas fa-fw fa-list-alt"></i> Détails
                                        </a>
                                        <a class="btn btn-warning bg-gradient-warning" href="fpdf/print.php?action=edit&id=' . $row['id_pointage'] . '">
                                            <i class="fas fa-fw fa-print"></i> Imprimez
                                        </a>
                                    </div>
                                  </td>';
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="PointageSurvModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Enregistrez une Fiche de Pointage</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="pointage_surv_transac.php?action=add">
                        <div class="form-group">
                            <?php echo $id_professeur; ?>
                        </div>
                        <div class="form-group">
                            <?php echo $id_classe; ?>
                        </div>
                        <div class="form-group">
                            <?php echo $id_matiere; ?>
                        </div>
                        <div class="form-group">
                            <input type="datetime-local" class="form-control" name="date_debut" required>
                        </div>
                        <div class="form-group">
                            <input type="datetime-local" class="form-control" name="date_fin" required>
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="statut" required>
                                <option value="valider">Valider</option>
                                <option value="non valider">Non valider</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input class="form-control" name="nom_ecole" value="<?php echo $nom_ecole; ?>" readonly>
                        </div>
                        <button type="submit" class="btn btn-success">Valider</button>
                        <button type="reset" class="btn btn-danger">Effacer</button>
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php
include'../includes/footer.php';
?>

<?php
include '../includes/connection.php';
include '../includes/sidebar_cens.php';

$sqlforjob = "SELECT DISTINCT libelle_classe, id_classe FROM classe ORDER BY id_classe ASC";
$result = mysqli_query($db, $sqlforjob) or die("Bad SQL: $sqlforjob");

$id_classe = "<select class='form-control' name='id_classe' id='id_classe' required>
        <option value='' disabled selected hidden>Selectionnez la classe</option>";
while ($row = mysqli_fetch_assoc($result)) {
    $id_classe .= "<option value='" . $row['id_classe'] . "'>" . $row['libelle_classe'] . "</option>";
}

$id_classe .= "</select>";

$sqlforjob = "SELECT DISTINCT libelle_matiere, id_matiere FROM matiere ORDER BY id_matiere ASC";
$result = mysqli_query($db, $sqlforjob) or die("Bad SQL: $sqlforjob");

$id_matiere = "<select class='form-control' name='id_matiere' required>
        <option value='' disabled selected hidden>Selectionnez la matiere</option>";
while ($row = mysqli_fetch_assoc($result)) {
    $id_matiere .= "<option value='" . $row['id_matiere'] . "'>" . $row['libelle_matiere'] . "</option>";
}

$id_matiere .= "</select>";

$sqlforjob = "SELECT DISTINCT nom_professeur, prenom_professeur, id_professeur FROM professeur ORDER BY id_professeur ASC";
$result = mysqli_query($db, $sqlforjob) or die("Bad SQL: $sqlforjob");

$id_professeur = "<select class='form-control' name='id_professeur' id='id_professeur' required>
        <option value='' disabled selected hidden>Selectionnez le professeur</option>";
while ($row = mysqli_fetch_assoc($result)) {
    $id_professeur .= "<option value='" . $row['id_professeur'] . "'>" . $row['nom_professeur'] . ' ' . $row['prenom_professeur'] . "</option>";
}

$id_professeur .= "</select>";
?>
<?php
$row_ecole = mysqli_fetch_assoc(mysqli_query($db, 'SELECT nom_ecole FROM utilisateur WHERE nom_user = "'.$_SESSION['nom_user'].'" AND prenom_user = "'.$_SESSION['prenom_user'].'"'));
$nom_ecole = $row_ecole['nom_ecole'];
?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h4 class="m-2 font-weight-bold text-primary">Attribution des programmes aux Professeurs</h4>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <form role="form" method="post" action="programme_transac.php?action=add">
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
    <input class="form-control" placeholder="Ecole" name="nom_ecole" value="<?php echo $nom_ecole; ?>" required readonly>
</div>
                <!-- Supprimez les autres champs de formulaire et gardez uniquement ceux ci-dessus -->
                <hr>
                <button type="submit" class="btn btn-success"><i class="fa fa-check fa-fw"></i>Attribuer</button>
                <button type="reset" class="btn btn-danger"><i class="fa fa-times fa-fw"></i>Effacez</button>
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Annulez</button>
            </form>
        </div>
    </div>
</div>
<?php
// Inclure le fichier de connexion à la base de données et le code PHP pour récupérer les données

// Code pour récupérer les données des tables professeur, classe et matiere
$sql = "SELECT p.nom_professeur, p.prenom_professeur, c.code_classe, m.libelle_matiere 
        FROM professeur p 
        JOIN attribution_programme ap ON p.id_professeur = ap.id_professeur 
        JOIN classe c ON ap.id_classe = c.id_classe 
        JOIN matiere m ON ap.id_matiere = m.id_matiere 
        WHERE ap.nom_ecole = (SELECT nom_ecole FROM utilisateur WHERE nom_user = '".$_SESSION['nom_user']."' AND prenom_user = '".$_SESSION['prenom_user']."')and ap.champ_visible=1";
$result = mysqli_query($db, $sql) or die("Bad SQL: $sql");
$row_ecole = mysqli_fetch_assoc(mysqli_query($db, 'SELECT nom_ecole FROM utilisateur WHERE nom_user = "'.$_SESSION['nom_user'].'" AND prenom_user = "'.$_SESSION['prenom_user'].'"'));
$nom_ecole = $row_ecole['nom_ecole'];
// Afficher les données dans un tableau HTML
if (mysqli_num_rows($result) > 0) {
    echo "<div class='card shadow mb-4'>
            <div class='card-body'>
                <div class='table-responsive'>
                    <table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>
                        <thead>
                            <tr>
                                <th>Nom Professeur</th>
                                <th>Prénom Professeur</th>
                                <th>Code Classe</th>
                                <th>Libellé Matière</th>
                            </tr>
                        </thead>
                        <tbody>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>" . $row['nom_professeur'] . "</td>
                <td>" . $row['prenom_professeur'] . "</td>
                <td>" . $row['code_classe'] . "</td>
                <td>" . $row['libelle_matiere'] . "</td>
              </tr>";
    }

    echo "</tbody>
          </table>
        </div>
      </div>
    </div>";
} else {
    echo "Aucune donnée trouvée.";
}
?>
<?php
include '../includes/footer.php';
?>

<!-- JavaScript to load program based on selected class -->
<script type="text/javascript">
    $(document).ready(function () {
        $('#id_classe').change(function () {
            var classe_id = $(this).val();
            $.ajax({
                url: 'get_programme.php',
                type: 'post',
                data: {classe_id: classe_id},
                dataType: 'json',
                success: function (response) {
                    var len = response.length;
                    $("#id_programme").empty();
                    for (var i = 0; i < len; i++) {
                        var id_programme = response[i]['id_programme'];
                        var contenu = response[i]['contenu'];
                        $("#id_programme").append("<option value='" + id_programme + "'>" + contenu + "</option>");
                    }
                }
            });
        });
    });
</script>



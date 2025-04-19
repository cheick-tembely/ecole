<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../includes/connection.php';
include '../includes/sidebar.php';

$query = 'SELECT id_user, t.niveau
          FROM utilisateur u
          JOIN niveau t ON t.id_niveau=u.id_niveau WHERE id_user = ' . $_SESSION['MEMBER_ID'] . '';
$result_niveau = mysqli_query($db, $query) or die(mysqli_error($db));

$sqlforjob = "SELECT DISTINCT niveau,id_niveau FROM niveau order by id_niveau asc";
$result_niveau_select = mysqli_query($db, $sqlforjob) or die("Bad SQL: $sqlforjob");

$sqlforjob = "SELECT DISTINCT niveau,id_niveau FROM niveau WHERE niveau IN ('Professeur', 'Parent','Censeur','Surveillant','Secretaire','Comptable','Proviseur','Bibliotheque') ORDER BY id_niveau ASC";
$result = mysqli_query($db, $sqlforjob) or die("Bad SQL: $sqlforjob");

$id_niveau = "<select class='form-control' name='id_niveau' required>
        <option value='' disabled selected hidden>Selectionnez le Niveau</option>";
while ($row = mysqli_fetch_assoc($result)) {
    $id_niveau .= "<option value='" . $row['id_niveau'] . "'>" . $row['niveau'] . "</option>";
}

$id_niveau .= "</select>";

$sqlforjob_antenne = "SELECT DISTINCT nom, id_antenne FROM antenne order by id_antenne asc";
$result_antenne = mysqli_query($db, $sqlforjob_antenne) or die("Bad SQL: $sqlforjob_antenne");

$id_antenne = "<select class='form-control' name='id_antenne' required>
        <option value='' disabled selected hidden>Selectionnez l'antenne</option>";
while ($row_antenne = mysqli_fetch_assoc($result_antenne)) {
    $id_antenne .= "<option value='" . $row_antenne['id_antenne'] . "'>" . $row_antenne['nom'] . "</option>";
}
$id_antenne .= "</select>";
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enregistrement Utilisateur</title>
    <!-- Bootstrap CSS -->
   
</head>
<body>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h4 class="m-2 font-weight-bold text-primary">Enregistrez un utilisateur&nbsp;
            <button type="button" class="btn btn-primary bg-gradient-primary" data-toggle="modal" data-target="#UserModal" style="border-radius: 0px;">
                <i class="fas fa-fw fa-plus"></i>
            </button>
        </h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prenom</th>
                        <th>GENRE</th>
                        <th>Email</th>
                        <th>Login</th>
                        <th>Niveau</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query_users = 'SELECT id_user, nom_user, prenom_user, GENDER, email_user, login, e.niveau
                    FROM utilisateur u
                    JOIN niveau e ON e.id_niveau=u.id_niveau
                    WHERE nom_ecole = (SELECT nom_ecole FROM ecole WHERE nom = "'.$_SESSION['nom_user'].'" AND prenom = "'.$_SESSION['prenom_user'].'")
                    AND u.champ_visible=1 ';
                    $result_users = mysqli_query($db, $query_users) or die(mysqli_error($db));
                    $row_ecole = mysqli_fetch_assoc(mysqli_query($db, 'SELECT nom_ecole FROM ecole WHERE nom = "'.$_SESSION['nom_user'].'" AND prenom = "'.$_SESSION['prenom_user'].'"'));
                    $nom_ecole = $row_ecole['nom_ecole'];
                    while ($row_user = mysqli_fetch_assoc($result_users)) {
                        echo '<tr>';
                        echo '<td>' . $row_user['nom_user'] . '</td>';
                        echo '<td>' . $row_user['prenom_user'] . '</td>';
                        echo '<td>' . $row_user['GENDER'] . '</td>';
                        echo '<td>' . $row_user['email_user'] . '</td>';
                        echo '<td>' . $row_user['login'] . '</td>';
                        echo '<td>' . $row_user['niveau'] . '</td>';
                        echo '<td align="right">
     <div class="btn-group">
    <!-- Modifier Icon -->
    <a type="button" class="btn btn-info bg-gradient-info mr-2" style="border-radius: 8px; padding: 10px 15px; box-shadow: 0px 4px 6px rgba(0,0,0,0.1);" href="us_edit.php?action=edit&id=' . $row_user['id_user'] . '" title="Modifier">
        <i class="fas fa-fw fa-edit" style="font-size: 1.2rem;"></i>
    </a>
    <!-- Bloquer Icon -->
    <a type="button" class="btn btn-warning bg-gradient-warning mr-2" style="border-radius: 8px; padding: 10px 15px; box-shadow: 0px 4px 6px rgba(0,0,0,0.1);" href="#" onclick="confirmBlockBloque(' . $row_user['id_user'] . ')" title="Bloquer">
        <i class="fa fa-ban fa-fw" style="font-size: 1.2rem;"></i>
    </a>
    <!-- Supprimer Icon -->
    <a type="button" class="btn btn-danger bg-gradient-danger" style="border-radius: 8px; padding: 10px 15px; box-shadow: 0px 4px 6px rgba(0,0,0,0.1);" href="#" onclick="confirmBlockDelete(' . $row_user['id_user'] . ')" title="Supprimer">
        <i class="fa fa-trash fa-fw" style="font-size: 1.2rem;"></i>
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

<!-- User Account Modal-->
<div class="modal fade" id="UserModal" tabindex="-1" role="dialog" aria-labelledby="ClasseModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ClasseModalLabel">Enregistrez un utilisateur</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" method="post" action="us_transac1.php?action=add">
                    <div class="form-group">
                    <label>Nom</label>
                        <input class="form-control" placeholder="Nom" name="nom_user" required>
                    </div>
                    <div class="form-group">
                    <label>Prenom</label>
                        <input class="form-control" placeholder="Prenom" name="prenom_user" required>
                    </div>
                    <div class="form-group">
                    <label>Sexe</label>
                        <select class="form-control" name="GENDER" required>
                            <option>MASCULIN</option>
                            <option>FEMININ</option>
                        </select>
                    </div>
                    <div class="form-group">
                    <label>Email</label>
                        <input class="form-control" placeholder="Email" name="email_user" required>
                    </div>
                    <div class="form-group">
                    <label>Nom Utilisateur</label>
                        <input class="form-control" placeholder="Login" name="login" required>
                    </div>
                    <div class="form-group">
                    <label>Mot de Passe</label>
                        <input type="password" class="form-control" placeholder="Password" name="password" required>
                    </div>
                    <div class="form-group">
                    <label>Miveau</label>
                        <?php echo $id_niveau; ?>
                    </div>
                   
                    <div class="form-group">
                        <input class="form-control" placeholder="Ecole" name="nom_ecole" value="<?php echo isset($nom_ecole) ? $nom_ecole : ''; ?>" required readonly>
                    </div>

                    <hr>
                    <button type="submit" class="btn btn-success"><i class="fa fa-check fa-fw"></i>Envoyer</button>
                    <button type="reset" class="btn btn-danger"><i class="fa fa-times fa-fw"></i>Effacer</button>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function confirmBlockBloque(userId) {
        var confirmBlockBloque = confirm("Voulez-vous vraiment bloquer cet utilisateur ?");
        if (confirmBlockBloque) {
            window.location.href = "us_del.php?id=" + userId;
        }
    }

    function confirmBlockDelete(id_user) {
        var confirmBlockDelete = confirm("Voulez-vous vraiment supprimer cet utilisateur ?");
        if (confirmBlockDelete) {
            window.location.href = "us_del_del.php?id=" + id_user;
        }
    }
</script>

<!-- Bootstrap JS and jQuery -->

</body>
</html>
<?php
include'../includes/footer.php';
?>

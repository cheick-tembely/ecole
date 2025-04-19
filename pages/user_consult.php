<?php
include '../includes/connection.php';
include '../includes/sidebar_consult.php';

$query = 'SELECT id_user, t.niveau
          FROM utilisateur u
          JOIN niveau t ON t.id_niveau=u.id_niveau WHERE id_user = ' . $_SESSION['MEMBER_ID'] . '';
$result = mysqli_query($db, $query) or die(mysqli_error($db));
?>

<?php
$sqlforjob = "SELECT DISTINCT niveau,id_niveau FROM niveau order by id_niveau asc";
$result = mysqli_query($db, $sqlforjob) or die("Bad SQL: $sqlforjob");

$id_niveau = "<select class='form-control' name='id_niveau' required>
        <option value='' disabled selected hidden>Selectionnez le Niveau</option>";
while ($row = mysqli_fetch_assoc($result)) {
    $id_niveau .= "<option value='" . $row['id_niveau'] . "'>" . $row['niveau'] . "</option>";
}

$id_niveau .= "</select>";
?>

<?php
$sqlforjob = "SELECT DISTINCT nom, id_antenne FROM antenne order by id_antenne asc";
$result = mysqli_query($db, $sqlforjob) or die("Bad SQL: $sqlforjob");

$id_antenne = "<select class='form-control' name='id_antenne' required>
        <option value='' disabled selected hidden>Selectionnez l'antenne</option>";
while ($row = mysqli_fetch_assoc($result)) {
    $id_antenne .= "<option value='" . $row['id_antenne'] . "'>" . $row['nom'] . "</option>";
}

$id_antenne .= "</select>";
?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h4 class="m-2 font-weight-bold text-primary">Liste des Utilisateurs</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th> Prenom</th>
                        <th>GENRE</th>
                        <th>Email</th>
                        <th>Login</th>
                        <th>Niveau</th>
                        <th>Antenne</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = 'SELECT  id_user, nom_user,prenom_user,GENDER,email_user,login, e.niveau,t.nom
                    FROM utilisateur u
                    JOIN niveau e ON e.id_niveau=u.id_niveau
                    JOIN antenne t on  u.id_antenne=t.id_antenne';
                    $result = mysqli_query($db, $query) or die(mysqli_error($db));

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>';
                        echo '<td>' . $row['nom_user'] . '</td>';
                        echo '<td>' . $row['prenom_user'] . '</td>';
                        echo '<td>' . $row['GENDER'] . '</td>';
                        echo '<td>' . $row['email_user'] . '</td>';
                        echo '<td>' . $row['login'] . '</td>';
                        echo '<td>' . $row['niveau'] . '</td>';
                        echo '<td>' . $row['nom'] . '</td>';
                        echo '<td align="right"> <div class="btn-group">
                        <a type="button" class="btn btn-primary bg-gradient-primary" href="user_consult_searchfrm.php?action=edit & id='.$row['id_user'] . '"><i class="fas fa-fw fa-list-alt"></i> Details</a>
                         
                            </div>
                          </div></td>';
                        echo '</tr> ';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
include '../includes/footer.php';

$sql = "SELECT  id_user, nom_user, prenom_user
        FROM utilisateur e
        JOIN niveau j ON j.id_niveau=e.id_niveau
        order by e.prenom_user asc";
$res = mysqli_query($db, $sql) or die("Bad SQL: $sql");
?>

<!-- User Account Modal-->
<div class="modal fade" id="supplierModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Enregistrez un utilisateur</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" method="post" action="us_transac1.php?action=add">
                    <div class="form-group">
                        <input class="form-control" placeholder="Nom" name="nom_user" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" placeholder="Prenom" name="prenom_user" required>
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="GENDER" required>
                            <option>Masculin</option>
                            <option>Feminin</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input class="form-control" placeholder="Email" name="email_user" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" placeholder="Login" name="login" required>
                    </div>
                    <div class="form-group">
                        <?php
                        echo $id_niveau;
                        ?>
                    </div>
                    <div class="form-group">
                        <?php
                        echo $id_antenne;
                        ?>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Password" name="password" required>
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-success"><i class="fa fa-check fa-fw"></i>Envoyez</button>
                    <button type="reset" class="btn btn-danger"><i class="fa fa-times fa-fw"></i>Effacez</button>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Annulez</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function confirmBlock(userId) {
        var confirmBlock = confirm("Voulez-vous vraiment bloquer cet utilisateur ?");
        if (confirmBlock) {
            window.location.href = "us_del.php?id=" + userId;
        }
    }
</script>

  
  
  
  
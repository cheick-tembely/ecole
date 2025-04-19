<?php
include'../includes/connection.php';

include'../includes/sidebar_secre.php';
$query = 'SELECT id_user, t.niveau
FROM utilisateur u
JOIN niveau t ON t.id_niveau=u.id_niveau WHERE id_user = '.$_SESSION['MEMBER_ID'].'';
  $result = mysqli_query($db, $query) or die (mysqli_error($db));
  
  while ($row = mysqli_fetch_assoc($result)) {
            $Aa = $row['niveau'];
                   
  if ($Aa=='User'){
?>
  <script type="text/javascript">
    //then it will be redirected
    alert("Restricted Page! You will be redirected to POS");
    window.location = "pos.php";
  </script>
<?php
  }           
}

// JOB SELECT OPTION TAB
$sql = "SELECT DISTINCT niveau, id_niveau FROM niveau";
$result = mysqli_query($db, $sql) or die ("Bad SQL: $sql");

$opt = "<select class='form-control' name='niveau'>";
  while ($row = mysqli_fetch_assoc($result)) {
    $opt .= "<option value='".$row['id_niveau']."'>".$row['niveau']."</option>";
  }

$opt .= "</select>";

        $query = "SELECT id_user, u.nom_user, u.prenom_user, u.email_user,u.GENDER, u.login, PASSWORD,n.niveau
                      FROM utilisateur u
                      join niveau n on u.id_niveau = n.id_niveau
                      WHERE id_user =".$_SESSION['MEMBER_ID'];
        $result = mysqli_query($db, $query) or die(mysqli_error($db));
          while($row = mysqli_fetch_array($result))
          {  
                $zz= $row['id_user'];
                $a= $row['nom_user'];
                $b=$row['prenom_user'];
                $c=$row['GENDER'];
                $d=$row['login'];
                $e=$row['PASSWORD'];
                $g=$row['email_user'];
                $l=$row['niveau'];
          }
                $id = $_GET['id'];
      ?>

        <div class="card shadow mb-4 col-xs-12 col-md-12 border-bottom-primary">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Modifiez un utilisateur</h4>
            </div>
            <div class="card-body">
      

            <form role="form" method="post" action="settings_prof_edit.php">
              <input type="hidden" name="id" value="<?php echo $zz; ?>" />

              <div class="form-group row text-left text-primary">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Nom:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="Nom" name="nom_user" value="<?php echo $a; ?>" required>
                </div>
              </div>
              <div class="form-group row text-left text-primary">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Prenom:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="Prenom" name="prenom_user" value="<?php echo $b; ?>" required>
                </div>
              </div>
              <div class="form-group row text-left text-primary">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Genre:
                </div>
                <div class="col-sm-9">
                  <select class='form-control' name='gender' required>
                    <option value="" disabled selected hidden>Selectionnez le Genre</option>
                    <option value="MASCULIN">MASCULIN</option>
                    <option value="FEMININ">FEMININ</option>
                  </select>
                </div>
              </div>
              <div class="form-group row text-left text-primary">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Login:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="Login" name="login" value="<?php echo $d; ?>" required>
                </div>
              </div>
              <div class="form-group row text-left text-primary">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Password:
                </div>
                <div class="col-sm-9">
                  <input type="password" class="form-control" placeholder="Password" name="PASSWORD" value="" required>
                </div>
              </div>
              <div class="form-group row text-left text-primary">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Email:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="Email" name="email_user" value="<?php echo $g; ?>" required>
                </div>
              </div>
              <div class="form-group row text-left text-primary">
                <div class="col-sm-3" style="padding-top: 5px;">
                  Niveau:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="Niveau" name="niveau" value="<?php echo $l; ?>" readonly>
                </div>
              </div>
              <hr>

                <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-edit fa-fw"></i>Modifiez</button>    
              </form>  
            </div>
          </div>        

<?php
include'../includes/footer.php';
?>
<?php
include'../includes/connection.php';

include'../includes/sidebar.php';
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

        $query = "SELECT id_user, e.nom_user, e.prenom_user, e.GENDER, email_user, login,PASSWORD,t.niveau,e.statut
                      FROM utilisateur e
                      join niveau t on e.id_niveau=t.id_niveau
                      WHERE id_user =".$_GET['id'];
        $result = mysqli_query($db, $query) or die(mysqli_error($db));
          while($row = mysqli_fetch_array($result))
          {  
                $zz= $row['id_user'];
                $a= $row['nom_user'];
                $b=$row['prenom_user'];
                $c=$row['GENDER'];
                $d=$row['email_user'];
                $e=$row['login'];
                $f=$row['PASSWORD'];
                $l=$row['niveau'];
                $s=$row['statut'];
          }
            $id = $_GET['id'];
      ?>

  <center><div class="card shadow mb-4 col-xs-12 col-md-8 border-bottom-primary">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Modifiez un compte</h4>
            </div><a  type="button" class="btn btn-primary bg-gradient-primary btn-block" href="user_admin.php?"> <i class="fas fa-flip-horizontal fa-fw fa-share"></i> Retour </a>
            <div class="card-body">
      

            <form role="form" method="post" action="us_edit1.php">
              <input type="hidden" name="id" value="<?php echo $zz; ?>" />

              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Nom:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="Nom" name="nom_user" value="<?php echo $a; ?>" required>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Prenom:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="Prenom" name="prenom_user" value="<?php echo $b; ?>" required>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Genre:
                </div>
                <div class="col-sm-9">
                  <select class='form-control' name='Genre' required>
                    <option value="" disabled selected hidden>Selectionnez le Genre</option>
                    <option value="Masculin">Masculin</option>
                    <option value="Feminin">Feminin</option>
                  </select>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Email:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="Email" name="email_user" value="<?php echo $d; ?>" required>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Login:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="Login" name="login" value="<?php echo $e; ?>" readonly>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Password:
                </div>
                <div class="col-sm-9">
                  <input type="password" class="form-control" placeholder="Password" name="password" value="" required>
                </div>
              </div>
 
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                  Niveau:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="Niveau" name="niveau" value="<?php echo $l; ?>" readonly>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                Statut:
                </div>
              <div class="col-sm-9">
                  <select class='form-control' name='statut' required>
                    <option value="" disabled selected hidden>Selectionnez le Statut(0=Debloquez,1=Bloquer)</option>
                    <option>0</option>
                    <option>1</option>
                  </select>
                </div>
              <hr>

                <button type="submit" class="btn btn-warning btn-block"><i class="fa fa-edit fa-fw"></i>Modifiez</button>    
              </form>  
            </div>
          </div></center>

<?php
include'../includes/footer.php';
?>
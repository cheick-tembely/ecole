<?php
include'../includes/connection.php';

include'../includes/sidebar_consult.php';

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
  $query2 = 'SELECT  id_user, nom_user,prenom_user,GENDER,email_user,login, e.niveau,t.nom
  FROM utilisateur u
  JOIN niveau e ON e.id_niveau=u.id_niveau
  JOIN antenne t on  u.id_antenne=t.id_antenne' ;

  $result2 = mysqli_query($db, $query2) or die(mysqli_error($db));
    while($row = mysqli_fetch_array($result2))
    {   
      $zz= $row['id_user'];
      $a= $row['nom_user'];
      $b=$row['prenom_user'];
      $c=$row['GENDER'];
      $d=$row['email_user'];
      $e=$row['login'];
      $f=$row['niveau'];
      $e=$row['login'];
      $f=$row['niveau'];
      $t=$row['nom'];
    
    }
    $id_user = $_GET['id'];
?>
          <center><div class="card shadow mb-4 col-xs-12 col-md-8 border-bottom-primary">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary"> Détail de l'utilisateur <?php echo $a; ?></h4>
            </div>
            <a href="user_consult.php?action=add" type="button" class="btn btn-primary bg-gradient-primary">Retour</a>
            <div class="card-body">
                
                    <div class="form-group row text-left">
                      <div class="col-sm-3 text-primary">
                        <h5>
                          Nom <br>
                        </h5>
                      </div>
                      <div class="col-sm-9">
                        <h5>
                          : <?php echo $a; ?>  <br>
                        </h5>
                      </div>
                    </div>
                    <div class="form-group row text-left">
                      <div class="col-sm-3 text-primary">
                        <h5>
                           Prenom<br>
                        </h5>
                      </div>
                      <div class="col-sm-9">
                        <h5>
                          :  <?php echo $b; ?> <br>
                        </h5>
                      </div>
                    </div>
                    <div class="form-group row text-left">
                      <div class="col-sm-3 text-primary">
                        <h5>
                          Gender<br>
                        </h5>
                      </div>
                      <div class="col-sm-9">
                        <h5>
                          : <?php echo $c; ?> <br>
                        </h5>
                      </div>
                    </div>
                    <div class="form-group row text-left">
                      <div class="col-sm-3 text-primary">
                        <h5>
                          Email<br>
                        </h5>
                      </div>
                      <div class="col-sm-9">
                        <h5>
                          : <?php echo $d; ?> <br>
                        </h5>
                      </div>
                    </div>
                    <div class="form-group row text-left">
                      <div class="col-sm-3 text-primary">
                        <h5>
                          Login<br>
                        </h5>
                      </div>
                      <div class="col-sm-9">
                        <h5>
                          : <?php echo $e; ?> <br>
                        </h5>
                      </div>
                    </div>
                    <div class="form-group row text-left">
                      <div class="col-sm-3 text-primary">
                        <h5>
                          Niveau<br>
                        </h5>
                      </div>
                      <div class="col-sm-9">
                        <h5>
                          : <?php echo $f; ?> <br>
                        </h5>
                      </div>
                    </div>
                    <div class="form-group row text-left">
                      <div class="col-sm-3 text-primary">
                        <h5>
                          Antenne<br>
                        </h5>
                      </div>
                      <div class="col-sm-9">
                        <h5>
                          : <?php echo $t; ?> <br>
                        </h5>
                      </div>
                    </div>
                 
                  
                   
                    
                   
          </div>
          </div>

<?php
include'../includes/footer.php';
?>
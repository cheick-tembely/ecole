<?php
include'../includes/connection.php';

include'../includes/sidebar_cens.php';

$query = 'SELECT id_user, t.niveau
FROM utilisateur u
JOIN niveau t ON t.id_niveau=u.id_niveau WHERE id_user = '.$_SESSION['MEMBER_ID'].'';
  $result = mysqli_query($db, $query) or die (mysqli_error($db));
  
  
  $query = 'SELECT id_emploi,jour,heure_debut,heure_fin,annee_scolaire from emploi  where id_emploi ='.$_GET['id'];
  $result = mysqli_query($db, $query) or die(mysqli_error($db));
    while($row = mysqli_fetch_array($result))
    {   
      $zz= $row['id_emploi'];
      $j= $row['jour'];
      $a=$row['heure_debut'];
      $niv=$row['heure_fin'];
      $b=$row['annee_scolaire'];
      
    
    }
    $id = $_GET['id'];
?>
            
            <center><div class="card shadow mb-4 col-xs-12 col-md-8 border-bottom-primary">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Modifiez une empoi du temps</h4>
            </div><a  type="button" class="btn btn-primary bg-gradient-primary btn-block" href="emploi_du_temp_cens.php?"> <i class="fas fa-flip-horizontal fa-fw fa-share"></i> Retour </a>
            <div class="card-body">
         
            <form role="form" method="post" action="emploi_cens_edit1.php">
              <input type="hidden" name="id" value="<?php echo $zz; ?>" />
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Jour:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="Jour" name="jour" value="<?php echo $j; ?>" required>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                heure_debut:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="heure_debut" name="heure_debut" value="<?php echo $a; ?>" required>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                heure_fin:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="heure_fin" name="heure_fin" value="<?php echo $niv; ?>" required>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                Année Scolaire:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="Année Scolaire" name="annee_scolaire" value="<?php echo $b; ?>" required>
                </div>
              </div>
             
              <hr>

                <button type="submit" class="btn btn-warning btn-block"><i class="fa fa-edit fa-fw"></i>Modifiez</button> 
              </form>  
          </div>
  </div>

<?php
include'../includes/footer.php';
?>
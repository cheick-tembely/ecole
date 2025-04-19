<?php
include'../includes/connection.php';

include'../includes/sidebar_cens.php';

$query = 'SELECT id_user, t.niveau
FROM utilisateur u
JOIN niveau t ON t.id_niveau=u.id_niveau WHERE id_user = '.$_SESSION['MEMBER_ID'].'';
  $result = mysqli_query($db, $query) or die (mysqli_error($db));
  
  
  $query = 'SELECT * FROM professeur WHERE id_professeur ='.$_GET['id'];
  $result = mysqli_query($db, $query) or die(mysqli_error($db));
    while($row = mysqli_fetch_array($result))
    {   
      $zz= $row['id_professeur'];
      $i= $row['nom_professeur'];
      $a=$row['prenom_professeur'];
      $b=$row['telephone1'];
      $c=$row['telephone2'];
      $d=$row['email'];
      $ad=$row['ville'];
      $ns =$row['profession'];
      $th =$row['employeur'];
      $dd =$row['dernier_diplome'];
    }  
      $id = $_GET['id'];
?>
            
            <center><div class="card shadow mb-4 col-xs-12 col-md-8 border-bottom-primary">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Modifiez un Professeur</h4>
            </div><a  type="button" class="btn btn-primary bg-gradient-primary btn-block" href="prof_cens.php?"> <i class="fas fa-flip-horizontal fa-fw fa-share"></i> Retour </a>
            <div class="card-body">
         
            <form role="form" method="post" action="prof_edit1.php">
              <input type="hidden" name="id" value="<?php echo $zz; ?>" />
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Nom:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="Nom" name="nom_professeur" value="<?php echo $i; ?>" required>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Prenom:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="Prenom" name="prenom_professeur" value="<?php echo $a; ?>" required>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                Telephone1:
                </div>
                <div class="col-sm-9">
                   <input class="form-control" placeholder="Telephone1" name="telephone1" value="<?php echo $b; ?>" required>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                Telephone2:
                </div>
                <div class="col-sm-9">
                   <input class="form-control" placeholder="Telephone2" name="telephone2" value="<?php echo $c; ?>" required>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                Email:
                </div>
                <div class="col-sm-9">
                   <input class="form-control" placeholder="Email" name="email" value="<?php echo $d; ?>" required>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                Ville:
                </div>
                <div class="col-sm-9">
                   <input class="form-control" placeholder="Ville" name="ville" value="<?php echo $ad; ?>" required>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                Profession:
                </div>
                <div class="col-sm-9">
                   <input class="form-control" placeholder="Profession" name="profession" value="<?php echo $ns; ?>" required>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                Employeur:
                </div>
                <div class="col-sm-9">
                   <input class="form-control" placeholder="Employeur" name="employeur" value="<?php echo $th; ?>" required>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                Dernier Diplome:
                </div>
                <div class="col-sm-9">
                   <input class="form-control" placeholder="Dernier Diplome" name="dernier_diplome" value="<?php echo $dd; ?>" required>
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
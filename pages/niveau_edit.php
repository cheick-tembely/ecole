<?php
include'../includes/connection.php';

include'../includes/sidebar_prof.php';

$query = 'SELECT id_user, t.niveau
FROM utilisateur u
JOIN niveau t ON t.id_niveau=u.id_niveau WHERE id_user = '.$_SESSION['MEMBER_ID'].'';
  $result = mysqli_query($db, $query) or die (mysqli_error($db));
  
  
  $query = 'SELECT * FROM niveau_enseignement WHERE id_niveau='.$_GET['id'];
  $result = mysqli_query($db, $query) or die(mysqli_error($db));
    while($row = mysqli_fetch_array($result))
    {   
      $zz= $row['id_niveau'];
      $i= $row['nom_prof'];
      $a=$row['prenom_prof'];
      $b=$row['dates'];
      $c=$row['contenu'];
      $d=$row['matiere'];
      $ad=$row['classe'];
     
    }  
      $id = $_GET['id'];
?>
            
            <center><div class="card shadow mb-4 col-xs-12 col-md-8 border-bottom-primary">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Modifiez une niveau d'enseignement</h4>
            </div><a  type="button" class="btn btn-primary bg-gradient-primary btn-block" href="niveau.php?"> <i class="fas fa-flip-horizontal fa-fw fa-share"></i> Retour </a>
            <div class="card-body">
         
            <form role="form" method="post" action="niveau_edit1.php">
              <input type="hidden" name="id" value="<?php echo $zz; ?>" />
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Nom du Professeur:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="Nom" name="nom_prof" value="<?php echo $i; ?>" required>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Prenom du Professeur:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="Prenom" name="prenom_prof" value="<?php echo $a; ?>" required>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                Date:
                </div>
                <div class="col-sm-9">
                   <input class="form-control" placeholder="Date" name="dates" value="<?php echo $b; ?>" required>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                Contenu:
                </div>
                <div class="col-sm-9">
                   <input class="form-control" placeholder="Contenu" name="contenu" value="<?php echo $c; ?>" required>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                Matiere:
                </div>
                <div class="col-sm-9">
                   <input class="form-control" placeholder="Matiere" name="matiere" value="<?php echo $d; ?>" required>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                Classe:
                </div>
                <div class="col-sm-9">
                   <input class="form-control" placeholder="Classe" name="classe" value="<?php echo $ad; ?>" required>
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
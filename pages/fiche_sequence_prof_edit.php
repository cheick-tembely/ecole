<?php
include'../includes/connection.php';

include'../includes/sidebar_prof.php';

$query = 'SELECT id_user, t.niveau
FROM utilisateur u
JOIN niveau t ON t.id_niveau=u.id_niveau WHERE id_user = '.$_SESSION['MEMBER_ID'].'';
  $result = mysqli_query($db, $query) or die (mysqli_error($db));
  
  
  $query = 'SELECT id_fiche,domaine,competence,titre,activite,annee_scolaire from fiche_sequence  where id_fiche ='.$_GET['id'];
  $result = mysqli_query($db, $query) or die(mysqli_error($db));
    while($row = mysqli_fetch_array($result))
    {   
      $zz= $row['id_fiche'];
      $j= $row['domaine'];
      $a=$row['competence'];
      $niv=$row['titre'];
      $b=$row['activite'];
      $ac=$row['annee_scolaire'];
      
    
    }
    $id = $_GET['id'];
?>
            
            <center><div class="card shadow mb-4 col-xs-12 col-md-8 border-bottom-primary">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Modifiez une Fiche de sequence</h4>
            </div><a  type="button" class="btn btn-primary bg-gradient-primary btn-block" href="fiche_sequence_prof.php?"> <i class="fas fa-flip-horizontal fa-fw fa-share"></i> Retour </a>
            <div class="card-body">
         
            <form role="form" method="post" action="fiche_sequence_prof_edit1.php">
              <input type="hidden" name="id" value="<?php echo $zz; ?>" />
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Domaine:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="Domaine" name="domaine" value="<?php echo $j; ?>" required>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                Compètence:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="Competence" name="competence" value="<?php echo $a; ?>" required>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                Titre:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="Titre" name="titre" value="<?php echo $niv; ?>" required>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                Activité:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="Activité" name="activite" value="<?php echo $b; ?>" required>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                Année Scolaire:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="Année Scolaire" name="annee_scolaire" value="<?php echo $ac; ?>" required>
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
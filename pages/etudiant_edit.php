<?php
include'../includes/connection.php';

include'../includes/sidebar_secre.php';

$query = 'SELECT id_user, t.niveau
FROM utilisateur u
JOIN niveau t ON t.id_niveau=u.id_niveau WHERE id_user = '.$_SESSION['MEMBER_ID'].'';
  $result = mysqli_query($db, $query) or die (mysqli_error($db));
  
  
  $query = 'SELECT * FROM etudiant WHERE id_etudiant ='.$_GET['id'];
  $result = mysqli_query($db, $query) or die(mysqli_error($db));
    while($row = mysqli_fetch_array($result))
    {   
      $zz= $row['id_etudiant'];
      $i= $row['nom'];
      $a=$row['prenom'];
      $b=$row['telephone'];
      $c=$row['nom_tuteur'];
      $d=$row['prenom_tuteur'];
      $ad=$row['telephone_tuteur'];
      $ns =$row['classe'];
      $se =$row['sexe'];
      $date =$row['date_naiss'];
      $stat =$row['statut'];
    }  
      $id = $_GET['id'];
?>
            
            <center><div class="card shadow mb-4 col-xs-12 col-md-8 border-bottom-primary">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Modifiez un Etudiant</h4>
            </div><a  type="button" class="btn btn-primary bg-gradient-primary btn-block" href="etudiant.php?"> <i class="fas fa-flip-horizontal fa-fw fa-share"></i> Retour </a>
            <div class="card-body">
         
            <form role="form" method="post" action="etudiant_edit1.php">
              <input type="hidden" name="id" value="<?php echo $zz; ?>" />
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Nom de l'étudiant:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="Nom" name="nom" value="<?php echo $i; ?>" required>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Prenom de l'étudiant:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="Prenom" name="prenom" value="<?php echo $a; ?>" required>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                Telephone:
                </div>
                <div class="col-sm-9">
                   <input class="form-control" placeholder="Telephone" name="telephone" value="<?php echo $b; ?>" required>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                Nom du Tuteur:
                </div>
                <div class="col-sm-9">
                   <input class="form-control" placeholder="Nom du Tuteur" name="nom_tuteur" value="<?php echo $c; ?>" required>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                Prenom du Tuteur:
                </div>
                <div class="col-sm-9">
                   <input class="form-control" placeholder="Prenom du Tuteur" name="prenom_tuteur" value="<?php echo $d; ?>" required>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                Telephone du Tuteur:
                </div>
                <div class="col-sm-9">
                   <input class="form-control" placeholder="Telephone du Tuteur" name="telephone_tuteur" value="<?php echo $ad; ?>" required>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                Classe:
                </div>
                <div class="col-sm-9">
                   <input class="form-control" placeholder="Classe" name="classe" value="<?php echo $ns; ?>" required>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                Sexe:
                </div>
              <div class="col-sm-9">
                  <select class='form-control' name='sexe' required>
                    <option value="" disabled selected hidden>Selectionnez le Sexe</option>
                    <option>Garçon</option>
                    <option>Fille</option>
                  </select>
                </div>
                </div>
                <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                Date Naissance:
                </div>
                <div class="col-sm-9">
                   <input type="date" class="form-control" placeholder="Date Naissance" name="date_naiss" value="<?php echo $date; ?>" required>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                Statut:
                </div>
                <div class="col-sm-9">
                   <input class="form-control" placeholder="Statut" name="statut" value="<?php echo $stat; ?>" required>
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
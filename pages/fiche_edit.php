<?php
include'../includes/connection.php';

include'../includes/sidebar_prof.php';
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
$sql ="SELECT id_pointage, pr.nom_professeur,pr.prenom_professeur, DATE_FORMAT(dates,'%d-%m-%Y') as dates, c.libelle_classe, m.libelle_matiere, debut, fin, observation  FROM pointage p, professeur pr,matiere m,classe c where p.id_professeur= pr.id_professeur
and p.id_matiere=m.id_matiere and c.id_classe=p.id_classe";
$result = mysqli_query($db, $sql) or die ("Bad SQL: $sql");



  $query = "SELECT id_pointage, pr.nom_professeur,pr.prenom_professeur, DATE_FORMAT(dates,'%d-%m-%Y') as dates, c.libelle_classe, m.libelle_matiere, debut, fin, observation  FROM pointage p, professeur pr,matiere m,classe c where p.id_professeur= pr.id_professeur
  and p.id_matiere=m.id_matiere and c.id_classe=p.id_classe and id_pointage =".$_GET['id'];
  $result = mysqli_query($db, $query) or die(mysqli_error($db));
    while($row = mysqli_fetch_array($result))
    {   
      $zz = $row['id_pointage'];
      $p = $row['nom_professeur'];
      $pr = $row['prenom_professeur'];
      $da = $row['dates'];
      $c = $row['libelle_classe'];
      $B = $row['libelle_matiere'];
      $C = $row['debut'];
      $D = $row['fin'];
      $E = $row['observation'];
    }
      $id = $_GET['id'];
?>

  <center><div class="card shadow mb-4 col-xs-12 col-md-8 border-bottom-primary">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Modifiez le Fiche de pointage du professeur : <?php echo $p ?></h4>
            </div>
            <a type="button" class="btn btn-primary bg-gradient-primary" href="fiche_searchfrm.php?action=edit"><i class="fas fa-fw fa-flip-horizontal fa-share"></i> Retour</a>
                
            <div class="card-body">

            <form role="form" method="post" action="fiche_edit1.php">
              <input type="hidden" name="idd" value="<?php echo $zz; ?>" />
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Nom du Professeur:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" value="<?php echo $p; ?>" readonly>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                Prenom  du Professeur:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" value="<?php echo $pr; ?>" readonly>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Date:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" value="<?php echo $da; ?>" readonly>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                Classe:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" value="<?php echo $c; ?>" readonly>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                matiere:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="matiere" name="matiere" value="<?php echo $B; ?>" required>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                Debut:
                </div>
                <div class="col-sm-9">
                <input class="form-control" value="<?php echo $C; ?>" readonly>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Fin:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" value="<?php echo $D; ?>" readonly>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                Titre Du cours:
                </div>
                <div class="col-sm-9">
                   <input class="form-control"value="<?php echo $E; ?>" readonly>
                </div>
              </div>
              <hr>

                <button type="submit" class="btn btn-warning btn-block"><i class="fa fa-edit fa-fw"></i>Modifiez</button>    
              </form>  
            </div>
          </div></center>

<?php
include'../includes/footer.php';
?>
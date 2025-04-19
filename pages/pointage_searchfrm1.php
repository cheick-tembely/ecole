<?php
include'../includes/connection.php';
include'../includes/sidebar_compt.php';
?><?php 

$query = 'SELECT id_user, t.niveau
FROM utilisateur u
JOIN niveau t ON t.id_niveau=u.id_niveau WHERE id_user = '.$_SESSION['MEMBER_ID'].'';
                $result = mysqli_query($db, $query) or die (mysqli_error($db));
      
                while ($row = mysqli_fetch_assoc($result)) {
                          $Aa = $row['niveau'];
                   
if ($Aa=='User'){
           
             ?>    <script type="text/javascript">
                      //then it will be redirected
                      alert("Restricted Page! You will be redirected to POS");
                      window.location = "pos.php";
                  </script>
             <?php   }
                                  
}   
  $query =  "SELECT id_pointage, pr.nom_professeur,pr.prenom_professeur, DATE_FORMAT(dates,'%d-%m-%Y') as dates, c.libelle_classe, m.libelle_matiere, debut, fin, observation  FROM pointage p, professeur pr,matiere m,classe c where p.id_professeur= pr.id_professeur
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
              <h4 class="m-2 font-weight-bold text-primary"> Detail De la Fiche du professeur </h4>
            </div>
            <a href="pointage_compt.php" type="button" class="btn btn-primary bg-gradient-primary btn-block"> <i class="fas fa-flip-horizontal fa-fw fa-share"></i> Retour </a>
            <div class="card-body">
                

                    <div class="form-group row text-left">

                      <div class="col-sm-3 text-primary">
                        <h5>
                          Nom <br>
                        </h5>
                      </div>

                      <div class="col-sm-9">
                        <h5>
                          : <?php echo $p; ?>  <br>
                        </h5>
                      </div>

                    </div>
                    <div class="form-group row text-left">

<div class="col-sm-3 text-primary">
  <h5>
    Prenom <br>
  </h5>
</div>

<div class="col-sm-9">
  <h5>
    : <?php echo $pr; ?>  <br>
  </h5>
</div>

</div>

                    <div class="form-group row text-left">

                      <div class="col-sm-3 text-primary">
                        <h5>
                          Date<br>
                        </h5>
                      </div>

                      <div class="col-sm-9">
                        <h5>
                          : <?php echo $da; ?> <br>
                        </h5>
                      </div>
                      
                    </div>
  <div class="form-group row text-left">

   <div class="col-sm-3 text-primary">
  <h5>
    Classe<br>
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
  Matière<br>
  </h5>
</div>

<div class="col-sm-9">
  <h5>
    : <?php echo $B; ?> <br>
  </h5>
</div>

</div> 
<div class="form-group row text-left">

<div class="col-sm-3 text-primary">
  <h5>
    Debut<br>
  </h5>
</div>

<div class="col-sm-9">
  <h5>
    : <?php echo $C; ?>  <br>
  </h5>
</div>

</div>
<div class="form-group row text-left">

<div class="col-sm-3 text-primary">
  <h5>
    Fin<br>
  </h5>
</div>

<div class="col-sm-9">
  <h5>
    : <?php echo $D; ?>  <br>
  </h5>
</div>

</div> 
<div class="form-group row text-left">

<div class="col-sm-3 text-primary">
  <h5>
    Observation<br>
  </h5>
</div>

<div class="col-sm-9">
  <h5>
    : <?php echo $E; ?>  <br>
  </h5>
</div>

</div>     

<?php
include'../includes/footer.php';
?>
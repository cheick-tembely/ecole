<?php
include'../includes/connection.php';
include'../includes/sidebar_prof.php';
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
$query = 'SELECT at.id_attribution,at.id_matiere,m.libelle_matiere,c.code_classe,p.id_professeur,p.nom_professeur,p.prenom_professeur,at.id_classe ,at.jour,at.heure_debut,at.heure_fin,at.volume  FROM attribution at ,professeur p , classe c, matiere m
where  at.id_professeur=p.id_professeur and  at.id_classe=c.id_classe and at.id_matiere=m.id_matiere and id_attribution ='.$_GET['id'];
  $result = mysqli_query($db, $query) or die(mysqli_error($db));
    while($row = mysqli_fetch_array($result))
    {   
      $zz= $row['id_attribution'];
      $i= $row['code_classe'];
      $a=$row['libelle_matiere'];
      $niv=$row['nom_professeur'];
      $b=$row['prenom_professeur'];
      $d=$row['jour'];
      $f=$row['heure_debut'];
      $n=$row['heure_fin'];
      $vo=$row['volume'];
    
    }
    $id = $_GET['id'];
?>
            
            <center><div class="card shadow mb-4 col-xs-12 col-md-8 border-bottom-primary">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary"> Detail De l'attribution du cour</h4>
            </div>
            <a href="emploi_du_temp_prof.php" type="button" class="btn btn-primary bg-gradient-primary btn-block"> <i class="fas fa-flip-horizontal fa-fw fa-share"></i> Retour </a>
            <div class="card-body">
                

                    <div class="form-group row text-left">

                      <div class="col-sm-3 text-primary">
                        <h5>
                         Classe<br>
                        </h5>
                      </div>

                      <div class="col-sm-9">
                        <h5>
                          : <?php echo $i; ?>  <br>
                        </h5>
                      </div>

                    </div>

                    <div class="form-group row text-left">

                      <div class="col-sm-3 text-primary">
                        <h5>
                        Matiere<br>
                        </h5>
                      </div>

                      <div class="col-sm-9">
                        <h5>
                          : <?php echo $a; ?> <br>
                        </h5>
                      </div>
                    </div>
                    <div class="form-group row text-left">

   <div class="col-sm-3 text-primary">
  <h5>
    Nom professeur<br>
    </h5>
</div>

<div class="col-sm-9">
  <h5>
    : <?php echo $niv; ?> <br>
  </h5>
</div>

</div>
  
  <div class="form-group row text-left">

   <div class="col-sm-3 text-primary">
  <h5>
    Prenom professeur<br>
    </h5>
</div>

<div class="col-sm-9">
  <h5>
    : <?php echo $b; ?> <br>
  </h5>
</div>

</div>
<div class="form-group row text-left">

<div class="col-sm-3 text-primary">
  <h5>
  Jour<br>
  </h5>
</div>

<div class="col-sm-9">
  <h5>
    : <?php echo $d; ?>  <br>
  </h5>
</div>

</div>
<div class="form-group row text-left">

<div class="col-sm-3 text-primary">
  <h5>
  Heure_debut<br>
  </h5>
</div>

<div class="col-sm-9">
  <h5>
    : <?php echo $f; ?>  <br>
  </h5>
</div>

</div>
<div class="form-group row text-left">

<div class="col-sm-3 text-primary">
  <h5>
  Heure_fin<br>
  </h5>
</div>

<div class="col-sm-9">
  <h5>
    : <?php echo $n; ?>  <br>
  </h5>
</div>

</div>
<div class="form-group row text-left">

<div class="col-sm-3 text-primary">
  <h5>
  Volume/Semaine<br>
  </h5>
</div>

<div class="col-sm-9">
  <h5>
    : <?php echo $vo; ?>  <br>
  </h5>
</div>

</div>

<?php
include'../includes/footer.php';
?>
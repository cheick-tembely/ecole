<?php
include'../includes/connection.php';
include'../includes/sidebar_surv.php';
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
  $query = 'SELECT * FROM annee_scolaire WHERE id_annee ='.$_GET['id'];
  $result = mysqli_query($db, $query) or die(mysqli_error($db));
    while($row = mysqli_fetch_array($result))
    {   
      $zz= $row['id_annee'];
      $i= $row['debut_annee'];
      $a=$row['fin_annee'];
      $b=$row['etat_annee'];
    
    }
    $id = $_GET['id'];
?>
            
            <center><div class="card shadow mb-4 col-xs-12 col-md-8 border-bottom-primary">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary"> Detail De l'Anneé Scolaire</h4>
            </div>
            <a href="annee_scolaire_surv.php" type="button" class="btn btn-primary bg-gradient-primary btn-block"> <i class="fas fa-flip-horizontal fa-fw fa-share"></i> Retour </a>
            <div class="card-body">
                

                    <div class="form-group row text-left">

                      <div class="col-sm-3 text-primary">
                        <h5>
                        Debut Anneé<br>
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
                        Fin Anneé<br>
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
    Etat<br>
    </h5>
</div>

<div class="col-sm-9">
  <h5>
    : <?php echo $b; ?> <br>
  </h5>
</div>

</div>


<?php
include'../includes/footer.php';
?>
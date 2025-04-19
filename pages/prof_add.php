<?php
include'../includes/connection.php';
include'../includes/sidebar.php';
?>

<?php 

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
            ?>
            
            <center><div class="card shadow mb-4 col-xs-12 col-md-8 border-bottom-primary">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Enregistrez un professeur</h4>
            </div>
            <a href="prof.php" type="button" class="btn btn-primary bg-gradient-primary">Retour</a>
            <div class="card-body">
                        <div class="table-responsive">
                        <form role="form" method="post" action="">
                          <div class="form-group">
                              <input class="form-control" placeholder="Nom" name="nom_professeur" required>
                            </div>
                            <div class="form-group">
                              <input class="form-control" placeholder="Prenom" name="prenom_professeur" required>
                            </div>
                            <div class="form-group">
                              <input class="form-control" placeholder="Profession" name="profession" required>
                            </div>
                            <div class="form-group">
                              <input class="form-control" placeholder="niveau_etude" name="niveau_etude" required>
                            </div>
                            <div class="form-group">
                              <input class="form-control" placeholder="Specialiter" name="Specialiter" required>
                            </div>
                            <div class="form-group">
                              <input class="form-control" placeholder="Adresse" name="adresse" required>
                            </div>
                            <div class="form-group">
                              <input class="form-control" placeholder="Niveau Enseignement" name="niveau_enseignement" required>
                            </div>
                            <div class="form-group">
                              <input class="form-control" placeholder="Taux Horaire en %" name="taux_horaire" required>
                            </div>
                            <hr>

                            <button type="submit" class="btn btn-success btn-block"><i class="fa fa-check fa-fw"></i>Envoyez</button>
                            <button type="reset" class="btn btn-danger btn-block"><i class="fa fa-times fa-fw"></i>Réinitialiser</button>
                            
                        </form>  
                      </div>
            </div>
          </div></center>
<?php
include'../includes/footer.php';
?>
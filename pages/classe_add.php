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
              <h4 class="m-2 font-weight-bold text-primary">Enregistrez une Classe</h4>
            </div>
            <a href="product.php?action=add" type="button" class="btn btn-primary bg-gradient-primary">Back</a>
            <div class="card-body">
                      <div class="table-responsive">



                        <form role="form" method="post" action="classe_transac.php?action=add">
                        <div class="form-group">
             <input class="form-control" placeholder="Code Classe" name="code_classe" required>
           </div>
           <div class="form-group">
             <input class="form-control" placeholder="Libelle Classe" name="libelle_classe" required>
           </div>
           <div class="form-group">
             <input class="form-control" placeholder="Filiere" name="filiere" required>
           </div>
                           
                            <hr>
                            <button type="submit" class="btn btn-success btn-block"><i class="fa fa-check fa-fw"></i>Save</button>
                            <button type="reset" class="btn btn-danger btn-block"><i class="fa fa-times fa-fw"></i>Reset</button>
                            
                        </form>  







                      </div>
            </div>
          </div></center>
        
<?php
include '../includes/footer.php';
?>

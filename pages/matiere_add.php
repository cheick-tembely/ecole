<?php
include'../includes/connection.php';
include'../includes/sidebar.php';
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
$sql = "SELECT DISTINCT id_matiere, libelle_matiere FROM matiere order by id_matiere asc";
$result = mysqli_query($db, $sql) or die ("Bad SQL: $sql");

$opt = "<select class='form-control' name='jobs'>
        <option>Select matiere</option>";
  while ($row = mysqli_fetch_assoc($result)) {
    $opt .= "<option value='".$row['id_matiere']."'>".$row['libelle_matiere']."</option>";
  }

$opt .= "</select>";
?>
<script>  
window.onload = function() {  

  // ---------------
  // basic usage
  // ---------------
  var $ = new City();
  $.showProvinces("#province");
  $.showCities("#city");

  // ------------------
  // additional methods 
  // -------------------

  // will return all provinces 
  console.log($.getProvinces());
  
  // will return all cities 
  console.log($.getAllCities());
  
  // will return all cities under specific province (e.g Batangas)
  console.log($.getCities("Batangas")); 
  
}
</script>
          <center><div class="card shadow mb-4 col-xs-12 col-md-8 border-bottom-primary">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Enregistrez une Matière</h4>
            </div>
            <a href="employee.php?action=add" type="button" class="btn btn-primary bg-gradient-primary">Retour</a>
            <div class="card-body">
              <div class="table-responsive">
                        <form role="form" method="post" action="matiere_transac.php?action=add">
                            
                            <div class="form-group">
                              <input class="form-control" placeholder="Matiere" name="libelle_matiere" required>
                            </div>
                            <div class="form-group">
                              <input class="form-control" placeholder="Nom de L'enseignant" name="professeur" required>
                            </div>
                            <div class="form-group">
                              <input class="form-control" placeholder="Filière Enseignèe" name="filiere" required>
                            </div>
                            <div class="form-group">
                              <input class="form-control" placeholder="Niveau Enseignement" name="niveau_enseignement" required>
                            </div>
                         
                           
                            <div class="form-group">
                              <?php
                                echo $opt;
                              ?>
                            </div>
                          
                            <hr>
                            <button type="submit" class="btn btn-success btn-block"><i class="fa fa-check fa-fw"></i>Envoyez</button>
                            <button type="reset" class="btn btn-danger btn-block"><i class="fa fa-times fa-fw"></i>Effacez</button>
                            
                        </form>  
                      </div>
            </div>
          </div></center>
        
<?php
include '../includes/footer.php';
?>


<!-- HOW TO PRINT YOUR VALUE JUST FOR CHECKINGGGGG
<script language='JavaScript'>
function getwords()
{
textbox = document.getElementById('FromDate');
if (textbox.value != "")
document.write("You entered: " + textbox.value)
else
alert("No word has been entered!")
}
</script>
<input type="button" onclick="getwords()" value="Enter" /> -->
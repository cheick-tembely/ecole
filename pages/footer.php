
<?php
include'../includes/connection.php';
?>
      </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
              <span>Copyright © 2023. ECOLE-GEST.</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Deconnexion</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body"><?php echo  $_SESSION['nom_user']; ?> Voulez-vous vraiment vous deconnectez?</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Annulez</button>
          <a class="btn btn-primary" href="logout.php">Deconnexion</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="../js/demo/datatables-demo.js"></script>
  <script src="../js/city.js"></script> 
  

<!-- PROFILE OVERLAY NA MODAL -->
<div id="overlay" onclick="off()">
  <section class="content">
                    <div style="center" class="container-fluid">
                        <div style="center" class="row">
                            <div qstyle="center" class="col-md-3">

                                <!-- Profile Image -->
                                <div style="center" class="card card-purple card-outline">
                                    <div class="card-body box-profile">
                                        <div class="text-center">
                                        <img class="img-profile rounded-circle"
                <?php
                  if($_SESSION['GENDER']=='MASCULIN'){
                    echo 'src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTS0rikanm-OEchWDtCAWQ_s1hQq1nOlQUeJr242AdtgqcdEgm0Dg"';
                  }else{
                    echo 'src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSNngF0RFPjyGl4ybo78-XYxxeap88Nvsyj1_txm6L4eheH8ZBu"';
                  }
                ?>>
                                        </div>

                                        <ul style="center" class="list-group list-group-unbordered mb-3">

                                        <li class="list-group-item">
                                                <b>Nom: </b> <a class="float-right"><?php echo $_SESSION['nom_user']. ' '.$_SESSION['prenom_user'] ;?></a>
                                            </li>

                                        
                                            <li class="list-group-item">
                                                <b>Email: </b> <a class="float-right"><?php echo $_SESSION['email_user']; ?></a>
                                            </li>
                                            <li class="list-group-item">
                                                <b>Niveau: </b> <a class="float-right"><?php echo $_SESSION['niveau']; ?></a>
                                            </li>
                                            <li class="list-group-item">
                                                <b>Genre: </b> <a class="float-right"><?php echo $_SESSION['GENDER']; ?></a>
                                            </li>

                                        </ul>

                                    </div><!-- Log on to codeastro.com for more projects! -->
                                    <!-- /.card-body -->
                                </div>
                                </div>
                                </div>
                                </div>
                                </secttion>
</div>
                
<script>
function on() {
  document.getElementById("overlay").style.display = "block";
}

function off() {
  document.getElementById("overlay").style.display = "none";
}

//used in pos sa number only na textfields
function isNumberKey(evt)
      {
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode != 46 && charCode > 31 
        && (charCode < 48 || charCode > 57))
        return false;
        return true;
      }  
//end of used in pos sa number only na textfields
</script>

</body>

</html>

 <?php
  include 'modal.php';
// JOB SELECT OPTION TAB
$sql = "SELECT DISTINCT niveau, id_niveau FROM niveau";
$result = mysqli_query($db, $sql) or die ("Bad SQL: $sql");

$opt = "<select class='form-control' name='niveau'>";
  while ($row = mysqli_fetch_assoc($result)) {
    $opt .= "<option value='".$row['id_niveau']."'>".$row['niveau']."</option>";
  }

$opt .= "</select>";
//antenne
$sqlforjob = "SELECT DISTINCT nom, id_antenne FROM antenne order by id_antenne asc";
$result = mysqli_query($db, $sqlforjob) or die("Bad SQL: $sqlforjob");

$id_antenne = "<select class='form-control' name='id_antenne' required>
        <option value='' disabled selected hidden>Selectionnez l'antenne</option>";
while ($row = mysqli_fetch_assoc($result)) {
    $id_antenne .= "<option value='" . $row['id_antenne'] . "'>" . $row['nom'] . "</option>";
}

$id_antenne .= "</select>";


$sql = "SELECT id_user,u.nom_user,u.GENDER,u.prenom_user,u.email_user,n.niveau,a.nom
FROM  `utilisateur` u
join `niveau` n on u.id_niveau=n.id_niveau
join 'antenne' a on u.id_antenne=a.id_antenne
                      WHERE id_user =".$_SESSION['MEMBER_ID'];
        $result = mysqli_query($db, $query) or die(mysqli_error($db));
          while($row = mysqli_fetch_array($result))
       
      ?> 

  <!-- User Edit Info Modal-->
  <div class="modal fade" id="settingsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modifiez les informations sur les utilisateurs</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form role="form" method="post" action="settings_edit.php">
              <input type="hidden" name="id_user" value="<?php echo $zz; ?>" />

              <div class="form-group row text-left text-primary">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Nom :
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="nom" name="nom_user" value="<?php echo $a; ?>" required>
                </div>
              </div>
              <div class="form-group row text-left text-primary">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Prenom:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="Prenom" name="prenom_user" value="<?php echo $b; ?>" required>
                </div>
              </div>
              <div class="form-group row text-left text-primary">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Genre:
                </div>
                <div class="col-sm-9">
                  <select class='form-control' name='gender' required>
                    <option value="" disabled selected hidden>Selectionnez Genre</option>
                    <option value="MASCULIN">MASCULIN</option>
                    <option value="FEMININ">FEMININ</option>
                  </select>
                </div>
              </div>
              <div class="form-group row text-left text-primary">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Email:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="Email" name="email_user" value="<?php echo $d; ?>" required>
                </div>
              </div>
              <div class="form-group row text-left text-primary">
                <div class="col-sm-3" style="padding-top: 5px;">
                 login:
                </div>
                <div class="col-sm-9">
                  <input type="login" class="form-control" placeholder="login" name="login" value="" required>
                </div>
              </div>
              <div class="form-group row text-left text-primary">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Password:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="Password" name="PASSWORD" value="<?php echo $f; ?>" required>
                </div>
              </div>
            
             
               
             
              
            
           
              <div class="form-group row text-left text-primary">
                <div class="col-sm-3" style="padding-top: 5px;">
                  Compte:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="Compte" name="niveau" value="<?php echo $l; ?>" readonly>
                </div>
              </div>
              <hr>
            <button type="submit" class="btn btn-success"><i class="fa fa-check fa-fw"></i>Envoyez</button>
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Fermez</button>      
          </form>  
        </div>
      </div>
    </div>
  </div>
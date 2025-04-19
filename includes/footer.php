
<?php
include'../includes/connection.php';
?>
      </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="bg-white py-4 border-t border-gray-200 mt-auto">
        <div class="container mx-auto px-4">
          <div class="text-center">
            <span class="text-gray-600 text-sm">Copyright © <span id="currentYear"></span> ECOLE-GEST. Tous droits réservés.</span>
          </div>
        </div>
      </footer>

      <script>
        // Script pour mettre à jour l'année courante
        document.getElementById("currentYear").textContent = new Date().getFullYear();
      </script>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="fixed bottom-6 right-6 p-3 bg-indigo-600 text-white rounded-full shadow-lg hover:bg-indigo-700 transition-colors duration-300 hidden" id="scrollToTop" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <script>
    // Afficher le bouton de retour en haut quand on scrolle
    window.addEventListener('scroll', function() {
      const scrollToTopBtn = document.getElementById('scrollToTop');
      if (window.pageYOffset > 300) {
        scrollToTopBtn.classList.remove('hidden');
      } else {
        scrollToTopBtn.classList.add('hidden');
      }
    });
  </script>

  <!-- Logout Modal-->
  <div class="fixed inset-0 items-center justify-center z-50 hidden" id="logoutModal">
    <div class="fixed inset-0 bg-black opacity-50" id="logoutModalOverlay"></div>
    <div class="bg-white rounded-lg shadow-xl max-w-md mx-auto z-10 relative overflow-hidden">
      <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
        <h5 class="text-lg font-semibold text-gray-700">Déconnexion</h5>
        <button class="text-gray-400 hover:text-gray-600" type="button" id="closeLogoutModal">
          <span class="text-2xl">&times;</span>
        </button>
      </div>
      <div class="p-6">
        <p class="text-gray-600 mb-4"><?php echo $_SESSION['nom_user']; ?>, voulez-vous vraiment vous déconnecter?</p>
        <div class="flex justify-end space-x-3">
          <button class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300 transition-colors duration-300" type="button" id="cancelLogout">Annuler</button>
          <a class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition-colors duration-300" href="../pages/logout.php">Déconnexion</a>
        </div>
      </div>
    </div>
  </div>

  <script>
    // Gestion du modal de déconnexion
    document.addEventListener('DOMContentLoaded', function() {
      const logoutLinks = document.querySelectorAll('[data-target="#logoutModal"]');
      const logoutModal = document.getElementById('logoutModal');
      const logoutModalOverlay = document.getElementById('logoutModalOverlay');
      const closeLogoutModal = document.getElementById('closeLogoutModal');
      const cancelLogout = document.getElementById('cancelLogout');
      
      function openLogoutModal() {
        logoutModal.classList.remove('hidden');
        logoutModal.classList.add('flex');
      }
      
      function closeModal() {
        logoutModal.classList.remove('flex');
        logoutModal.classList.add('hidden');
      }
      
      logoutLinks.forEach(link => {
        link.addEventListener('click', function(e) {
          e.preventDefault();
          openLogoutModal();
        });
      });
      
      if (closeLogoutModal) closeLogoutModal.addEventListener('click', closeModal);
      if (cancelLogout) cancelLogout.addEventListener('click', closeModal);
      if (logoutModalOverlay) logoutModalOverlay.addEventListener('click', closeModal);
    });
  </script>

  <!-- PROFILE OVERLAY -->
  <div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4 overflow-hidden">
      <div class="p-6">
        <div class="flex justify-between items-center mb-4">
          <h3 class="text-xl font-bold text-indigo-700">Profil Utilisateur</h3>
          <button onclick="off()" class="text-gray-400 hover:text-gray-600 focus:outline-none">
            <i class="fas fa-times"></i>
          </button>
        </div>
        
        <div class="flex flex-col items-center mb-6">
          <img class="h-24 w-24 rounded-full border-4 border-indigo-200 mb-3"
            <?php
              if($_SESSION['GENDER']=='MASCULIN'){
                echo 'src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTS0rikanm-OEchWDtCAWQ_s1hQq1nOlQUeJr242AdtgqcdEgm0Dg"';
              }else{
                echo 'src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSNngF0RFPjyGl4ybo78-XYxxeap88Nvsyj1_txm6L4eheH8ZBu"';
              }
            ?> alt="Profile">
          <h4 class="text-lg font-semibold text-gray-800"><?php echo $_SESSION['nom_user']. ' '.$_SESSION['prenom_user']; ?></h4>
          <span class="text-sm text-gray-500"><?php echo $_SESSION['niveau']; ?></span>
        </div>
        
        <div class="space-y-3">
          <div class="flex justify-between py-2 border-b border-gray-100">
            <span class="text-gray-600">Email:</span>
            <span class="text-gray-800 font-medium"><?php echo $_SESSION['email_user']; ?></span>
          </div>
          <div class="flex justify-between py-2 border-b border-gray-100">
            <span class="text-gray-600">Niveau:</span>
            <span class="text-gray-800 font-medium"><?php echo $_SESSION['niveau']; ?></span>
          </div>
          <div class="flex justify-between py-2 border-b border-gray-100">
            <span class="text-gray-600">Genre:</span>
            <span class="text-gray-800 font-medium"><?php echo $_SESSION['GENDER']; ?></span>
          </div>
        </div>
        
        <div class="mt-6 text-center">
          <button onclick="off()" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition-colors duration-300">
            Fermer
          </button>
        </div>
      </div>
    </div>
  </div>
                
  <script>
  function on() {
    document.getElementById("overlay").style.display = "flex";
  }

  function off() {
    document.getElementById("overlay").style.display = "none";
  }
  </script>

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

</body>
</html>

 <?php
  include 'modal.php';

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
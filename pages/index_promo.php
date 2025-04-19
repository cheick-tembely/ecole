<?php
include'../includes/connection.php';

include'../includes/sidebar_promo.php';
require_once('fonctions.php');
$as = annee_scolaire_actuelle();
?><?php 

                $query = 'SELECT id_user, n.niveau
                          FROM utilisateur u
                          JOIN niveau n ON n.id_niveau=u.id_niveau WHERE id_user = '.$_SESSION['MEMBER_ID'].'';
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
          <div class="row show-grid">
            <!-- Customer ROW -->
            <div class="col-md-3">
            <!-- Customer record -->
            <div class="col-md-12 mb-3">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-0">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Professeurs</div>
                      <div class="h6 mb-0 font-weight-bold text-gray-800">
                        <?php 
                        $query = "SELECT COUNT(*) FROM professeur";
                        $result = mysqli_query($db, $query) or die(mysqli_error($db));
                        while ($row = mysqli_fetch_array($result)) {
                            echo "$row[0]";
                          }
                        ?> Enregistrements
                      </div>
                    </div>
                      <div class="col-auto">
                      <i class="fas fa-chalkboard-teacher fa-2x text-gray-300"></i>

                      </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12 mb-3">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-0">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Etudiants</div>
                      <div class="h6 mb-0 font-weight-bold text-gray-800">
                        <?php 
                        $query = "SELECT COUNT(*) FROM etudiant";
                        $result = mysqli_query($db, $query) or die(mysqli_error($db));
                        while ($row = mysqli_fetch_array($result)) {
                            echo "$row[0]";
                          }
                        ?> Enregistrements
                      </div>
                    </div>
                      <div class="col-auto">
                      <i class="fas fa-user-friends fa-2x text-gray-300"></i>

                      </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Supplier record -->
            <div class="col-md-12 mb-3">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-0">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Nombre d'emargements</div>
                      <div class="h6 mb-0 font-weight-bold text-gray-800">
                        <?php 
                        $query = "SELECT COUNT(*) FROM emargement";
                        $result = mysqli_query($db, $query) or die(mysqli_error($db));
                        while ($row = mysqli_fetch_array($result)) {
                            echo "$row[0]";
                          }
                        ?> Enregistrements
                      </div>
                    </div>
                    <div class="col-auto">
                    <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>

                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
            <!-- Employee ROW -->
          <div class="col-md-3">
            <!-- Employee record -->
            <div class="col-md-12 mb-3">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-0">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">utilisateurs</div>
                      <div class="h6 mb-0 font-weight-bold text-gray-800">
                        <?php 
                        $query = "SELECT COUNT(*) FROM utilisateur";
                        $result = mysqli_query($db, $query) or die(mysqli_error($db));
                        while ($row = mysqli_fetch_array($result)) {
                            echo "$row[0]";
                          }
                        ?> Enregistrements
                      </div>
                    </div>
                    <div class="col-auto">
                    <i class="fas fa-user-friends fa-2x text-gray-300"></i>

                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- User record -->
            <div class="col-md-12 mb-3">
              <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-0">
                      <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Classes</div>
                      <div class="h6 mb-0 font-weight-bold text-gray-800">
                        <?php 
                        $query = "SELECT COUNT(*) FROM classe";
                        $result = mysqli_query($db, $query) or die(mysqli_error($db));
                        while ($row = mysqli_fetch_array($result)) {
                            echo "$row[0]";
                          }
                        ?> Enregistrements
                      </div>
                    </div>
                    <div class="col-auto">
                    <i class="fas fa-school fa-2x text-gray-300"></i>

                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
          <!-- PRODUCTS ROW -->
          <div class="col-md-3">
            <!-- Product record -->
            <div class="col-md-12 mb-3">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">

                    <div class="col mr-0">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Annèe Scolaire</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h6 mb-0 mr-3 font-weight-bold text-gray-800">
                          <?php 
                        echo $as;
                          while ($row = mysqli_fetch_array($result)) {
                              echo "$row[0]";
                            }
                          ?> Actif
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-auto">
                    <i class="fas fa-calendar-alt fa-2x text-gray-300"></i>

                    </div>

                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12 mb-3">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-0">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Antennes</div>
                      <div class="h6 mb-0 font-weight-bold text-gray-800">
                        <?php 
                        $query = "SELECT COUNT(*) FROM antenne";
                        $result = mysqli_query($db, $query) or die(mysqli_error($db));
                        while ($row = mysqli_fetch_array($result)) {
                            echo "$row[0]";
                          }
                        ?> Enregistrements
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fa fa-university fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
          
            
          <!-- RECENT PRODUCTS -->
               


<?php
include'../includes/footer.php';
?>
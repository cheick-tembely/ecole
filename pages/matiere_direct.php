<?php
include'../includes/connection.php';

include'../includes/sidebar_direct.php';
?><?php 

$query = 'SELECT id_user, t.niveau
FROM utilisateur u
JOIN niveau t ON t.id_niveau=u.id_niveau WHERE id_user = '.$_SESSION['MEMBER_ID'].'';
                $result = mysqli_query($db, $query) or die (mysqli_error($db));
      
                while ($row = mysqli_fetch_assoc($result)) {
                          $Aa = $row['niveau'];
                   

                         
           
}   
            ?>
            <script src="js/jquery-1.10.2.js"></script>
		<script src="js/bootstrap.min.js"></script>
            <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Enregistrez une Matière&nbsp;<a  href="#" data-toggle="modal" data-target="#employModal" type="button" class="btn btn-primary bg-gradient-primary" style="border-radius: 0px;"><i class="fas fa-fw fa-plus"></i></a></h4>
            </div>
            
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"> 
                  <thead>
                        <tr>
                          <th>Matière</th>
                          <th>Filière Enseignèe</th>
                          <th>Niveau Enseignement</th>
                          <th>Action</th>
                        </tr>
                     </thead>
                    <tbody>
                    <?php                  
                        $query = 'SELECT * FROM matiere  ';
                        $result = mysqli_query($db, $query) or die (mysqli_error($db));
                        while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>';
                        echo '<td>'. $row['libelle_matiere'].'</td>';
                        echo '<td>'. $row['filiere'].'</td>';
                        echo '<td>'. $row['niveau_enseignement'].'</td>';
                        

                        echo '<td align="right"> <div class="btn-group">
                              <a type="button" class="btn btn-primary bg-gradient-primary" href="matiere_direct_searchfrm.php?action=edit & id='.$row['id_matiere'] . '"><i class="fas fa-fw fa-list-alt"></i> Details</a>
                            <div class="btn-group">
                              <a type="button" class="btn btn-primary bg-gradient-primary dropdown no-arrow" data-toggle="dropdown" style="color:white;">
                              ... <span class="caret"></span></a>
                            <ul class="dropdown-menu text-center" role="menu">
                                <li>
                                  <a type="button" class="btn btn-warning bg-gradient-warning btn-block" style="border-radius: 0px;" href="matiere_direct_edit.php?action=edit & id='.$row['id_matiere']. '">
                                    <i class="fas fa-fw fa-edit"></i> Modifiez
                                  </a>
                                </li>
                                
                           
                            </ul>
                            </div>
                          </div> </td>';
                        echo '</tr> ';
                        }
                    ?> 
                    
                                 
                    </tbody>
                </table>
              </div>
            </div>
          </div>
           <!-- Employee Modal-->
  <div class="modal fade" id="employModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Enregistrez une Matière</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
        <form role="form" method="post" action="matiere_transac1.php?action=add">
                            
                            <div class="form-group">
                              <input class="form-control" placeholder="Matiere" name="libelle_matiere" required>
                            </div>
                            <div class="form-group">
                              <input class="form-control" placeholder="Filière Enseignèe" name="filiere" required>
                            </div>
                            <div class="form-group">
                              <input class="form-control" placeholder="Niveau Enseignement" name="niveau_enseignement" required>
                            </div>
                          
             
           
            
              <hr>
              <button type="submit" class="btn btn-success"><i class="fa fa-check fa-fw"></i>Envoyez</button>
            <button type="reset" class="btn btn-danger"><i class="fa fa-times fa-fw"></i>Effacez</button>
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Annulez</button>       
          </form>  
        </div>
      </div>
    </div>
  </div>
          <script type="text/javascript">
    function confirmBlock(id_matiere) {
        var confirmBlock = confirm("Voulez-vous vraiment supprimer cette matière ?");
        if (confirmBlock) {
            window.location.href = "matiere_del.php?id=" + id_matiere;
        }
    }
</script>

<?php
include'../includes/footer.php';
?>
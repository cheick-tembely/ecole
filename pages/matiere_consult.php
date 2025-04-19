<?php
include'../includes/connection.php';

include'../includes/sidebar_consult.php';
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
              <h4 class="m-2 font-weight-bold text-primary">Liste des Matières</h4>
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
                              <a type="button" class="btn btn-primary bg-gradient-primary" href="matiere_consult_searchfrm.php?action=edit & id='.$row['id_matiere'] . '"><i class="fas fa-fw fa-list-alt"></i> Details</a>
                          
                          </div> </td>';
                        echo '</tr> ';
                        }
                    ?> 
                    
                                 
                    </tbody>
                </table>
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
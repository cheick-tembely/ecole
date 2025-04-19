<?php

include'../includes/connection.php';
?>
          <!-- Page Content -->
          <div class="col-lg-12">
            <?php
              $fname = $_POST['code_classe'];
              $lname = $_POST['libelle_classe'];
              $niv = $_POST['niveau'];
              $pn = $_POST['id_filiere'];
              $ann = $_POST['id_annee'];
              $t = $_POST['id_antenne'];
             
             
        
              mysqli_query($db,"INSERT INTO classe
              (id_classe, code_classe,libelle_classe,niveau,id_filiere,id_annee,id_antenne)
              VALUES (Null,'$fname','$lname','$niv','$pn','$ann','$t')");
              
            ?>
               <script type="text/javascript">window.location = "classe_direct.php";</script>  
          </div>

<?php
include'../includes/footer.php';
?>
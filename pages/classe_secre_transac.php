<?php

include'../includes/connection.php';
?>
          <!-- Page Content -->
          <div class="col-lg-12">
            <?php
              $fname = $_POST['code_classe'];
              $lname = $_POST['libelle_classe'];
              $niv = $_POST['niveau'];
              $pn = $_POST['annee_scolaire'];
              $nt = $_POST['nombre_table'];
              $nom_ecole = $_POST['nom_ecole'];
             
             
        
              mysqli_query($db,"INSERT INTO classe
              (id_classe, code_classe,libelle_classe,niveau,annee_scolaire,nombre_table,nom_ecole)
              VALUES (Null,'$fname','$lname','$niv','$pn','$nt','$nom_ecole')");
              
            ?>
               <script type="text/javascript">window.location = "classe_secre.php";</script>  
          </div>

<?php
include'../includes/footer.php';
?>
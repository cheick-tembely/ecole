<?php

include'../includes/connection.php';
?>
          <!-- Page Content -->
          <div class="col-lg-12">
            <?php
              
              $pc = $_POST['filiere'];
            
          
        
              mysqli_query($db,"INSERT INTO filiere
              (id_filiere,filiere)
              VALUES (Null,'$pc')");
            ?>
               <script type="text/javascript">window.location = "filiere_direct.php";</script> 
          </div>

<?php
include'../includes/footer.php';
?>
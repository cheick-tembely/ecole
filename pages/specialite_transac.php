<?php

include'../includes/connection.php';
?>
          <!-- Page Content -->
          <div class="col-lg-12">
            <?php
              
              $pc = $_POST['specialite'];
            
          
        
              mysqli_query($db,"INSERT INTO specialite
              (id_specialite,specialite)
              VALUES (Null,'$pc')");
            ?>
               <script type="text/javascript">window.location = "specialite.php";</script> 
          </div>

<?php
include'../includes/footer.php';
?>
<?php

include'../includes/connection.php';
?>
          <!-- Page Content -->
          <div class="col-lg-12">
            <?php
              $fname = $_POST['region'];
              $lname = $_POST['ville'];
              $pn = $_POST['quartier'];
              $nm = $_POST['nom'];
             
        
              mysqli_query($db,"INSERT INTO antenne
              (id_antenne, region,ville,quartier,nom)
              VALUES (Null,'$fname','$lname','$pn','$nm')");
              
            ?>
               <script type="text/javascript">window.location = "antenne_direct.php";</script> 
          </div>

<?php
include'../includes/footer.php';
?>
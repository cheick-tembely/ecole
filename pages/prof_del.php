<?php
include'../includes/connection.php';
include'../includes/sidebar.php';
?>
 <?php

    			$query = 'DELETE FROM professeur WHERE id_professeur = ' . $_GET['id'];
    			$result = mysqli_query($db, $query) or die(mysqli_error($db));				
            ?>
    			<script type="text/javascript">alert("professeur supprimez avec succès.");window.location = "prof_admin.php";</script>					
           
    			
            
	

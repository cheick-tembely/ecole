<?php
include'../includes/connection.php';
include'../includes/sidebar.php';
?>
 <?php

    			$query = 'DELETE FROM programme WHERE id_programme = ' . $_GET['id'];
    			$result = mysqli_query($db, $query) or die(mysqli_error($db));				
            ?>
    			<script type="text/javascript">alert("Programme supprimez avec succès.");window.location = "programme_admin.php";</script>					
           
    			
            
	

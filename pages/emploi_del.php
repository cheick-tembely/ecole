<?php

include'../includes/connection.php';

	
    			$query = 'DELETE FROM emploi WHERE id_emploi = ' . $_GET['id'];
    			$result = mysqli_query($db, $query) or die(mysqli_error($db));				
            ?>
    			<script type="text/javascript">alert("Emploi du Temps supprimez avec succès.");window.location = "emploi_du_temp_admin.php";</script>					
  
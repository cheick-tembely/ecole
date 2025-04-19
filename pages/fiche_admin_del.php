<?php

include'../includes/connection.php';

	
    			$query = 'DELETE FROM fiche_sequence WHERE id_fiche = ' . $_GET['id'];
    			$result = mysqli_query($db, $query) or die(mysqli_error($db));				
            ?>
    			<script type="text/javascript">alert("Fiche de sequence supprimez avec succès.");window.location = "fiche_sequence_admin.php";</script>					
  
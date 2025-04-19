<?php

include'../includes/connection.php';

	
    			$query = 'DELETE FROM annee_scolaire WHERE id_annee = ' . $_GET['id'];
    			$result = mysqli_query($db, $query) or die(mysqli_error($db));				
            ?>
    			<script type="text/javascript">alert("Anneé Scolaire supprimez avec succès.");window.location = "annee_scolaire.php";</script>					
  
<?php

include('../includes/connection.php');
			$zz = $_POST['idd'];
            $a = $_POST['matiere'];
            
		
	 			$query = 'UPDATE matiere set libelle_matiere="'.$a.'" WHERE
					id_matiere ="'.$zz.'"';
					$result = mysqli_query($db, $query) or die(mysqli_error($db));
?>	
	<script type="text/javascript">
			alert("Fiche de pointage modifiez avec succès.");
			window.location = "fiche_prof.php";
		</script>
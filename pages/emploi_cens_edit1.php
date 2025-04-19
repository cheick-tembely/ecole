<?php
include('../includes/connection.php');
			$zz = $_POST['id'];
			$fname = $_POST['jour'];
		    $lname = $_POST['heure_debut'];
			$niv = $_POST['heure_fin'];
            $b=$_POST['annee_scolaire'];
		
	 			$query = 'UPDATE emploi set jour ="'.$fname.'",
				 heure_debut ="'.$lname.'",heure_fin="'.$niv.'",annee_scolaire="'.$b.'" WHERE
				 id_emploi ="'.$zz.'"';
					$result = mysqli_query($db, $query) or die(mysqli_error($db));
		
					
?>	
	<script type="text/javascript">
			alert("Emploi du temps modifiez avec succès.");
			window.location = "emploi_du_temp_cens.php";
		</script>
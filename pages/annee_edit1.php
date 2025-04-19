<?php
include('../includes/connection.php');
			$zz = $_POST['id'];
            $fname = $_POST['debut_annee'];
            $lname = $_POST['fin_annee'];
            $pr = $_POST['etat_annee'];
			
		
	 			$query = 'UPDATE annee_scolaire set debut_annee ="'.$fname.'",
				 fin_annee ="'.$lname.'", etat_annee="'.$pr.'" WHERE
				 id_annee ="'.$zz.'"';
					$result = mysqli_query($db, $query) or die(mysqli_error($db));
		
					
?>	
	<script type="text/javascript">
			alert("Anneé Scolaire modifiez avec succès.");
			window.location = "annee_scolaire.php";
		</script>
<?php
include('../includes/connection.php');
			$zz = $_POST['id'];
			$fname = $_POST['nom_prof'];
		    $lname = $_POST['prenom_prof'];
			$pr = $_POST['dates'];
			$ne = $_POST['contenu'];
			$sp=$_POST['matiere'];
			$ad=$_POST['classe'];
			
		
	 			$query = 'UPDATE niveau_enseignement set nom_prof ="'.$fname.'",
				 prenom_prof ="'.$lname.'", dates="'.$pr.'",contenu="'.$ne.'",matiere="'.$sp.'",classe="'.$ad.'"  WHERE
				 id_niveau ="'.$zz.'"';
					$result = mysqli_query($db, $query) or die(mysqli_error($db));
		
					
?>	
	<script type="text/javascript">
			alert("Niveau d'enseignement modifiez avec succès.");
			window.location = "niveau.php";
		</script>
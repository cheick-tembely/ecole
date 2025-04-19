<?php
include('../includes/connection.php');
			$zz = $_POST['id'];
			$fname = $_POST['nom'];
		    $lname = $_POST['prenom'];
			$pr = $_POST['nom_etudiant'];
			$ne = $_POST['prenom_etudiant'];
			$sp=$_POST['classe'];
			$ad=$_POST['matiere'];
			$pn = $_POST['dates']; 
			$ju = $_POST['justifier'];
		
	 			$query = 'UPDATE absence_surveillant set nom ="'.$fname.'",
				 prenom ="'.$lname.'", nom_etudiant="'.$pr.'",prenom_etudiant="'.$ne.'",classe="'.$sp.'",matiere="'.$ad.'",dates="'.$pn.'" ,justifier="'.$ju.'" WHERE
				 id_absence ="'.$zz.'"';
					$result = mysqli_query($db, $query) or die(mysqli_error($db));
		
					
?>	
	<script type="text/javascript">
			alert("Absence modifiez avec succès.");
			window.location = "absence_surv.php";
		</script>
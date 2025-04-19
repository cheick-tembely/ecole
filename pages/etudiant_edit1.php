<?php
include('../includes/connection.php');
			$zz = $_POST['id'];
			$fname = $_POST['nom'];
		    $lname = $_POST['prenom'];
			$pr = $_POST['telephone'];
			$ne = $_POST['nom_tuteur'];
			$sp=$_POST['prenom_tuteur'];
			$ad=$_POST['telephone_tuteur'];
			$pn = $_POST['classe']; 
			$se = $_POST['sexe']; 
			$date = $_POST['date_naiss']; 
			$stat = $_POST['statut']; 
			
		
	 			$query = 'UPDATE etudiant set nom ="'.$fname.'",
				 prenom ="'.$lname.'", telephone="'.$pr.'",nom_tuteur="'.$ne.'",prenom_tuteur="'.$sp.'",telephone_tuteur="'.$ad.'",classe="'.$pn.'" ,sexe="'.$se.'",date_naiss="'.$date.'",statut="'.$stat.'"  WHERE
				 id_etudiant ="'.$zz.'"';
					$result = mysqli_query($db, $query) or die(mysqli_error($db));
		
					
?>	
	<script type="text/javascript">
			alert("étudiant modifiez avec succès.");
			window.location = "etudiant.php";
		</script>
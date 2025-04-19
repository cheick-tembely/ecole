<?php
include('../includes/connection.php');
			$zz = $_POST['id'];
			$fname = $_POST['statut'];
		   
			
		
	 			$query = 'UPDATE transfert_ecole set statut ="'.$fname.'" WHERE
				 id ="'.$zz.'"';
					$result = mysqli_query($db, $query) or die(mysqli_error($db));
		
					
?>	
	<script type="text/javascript">
			alert("Transfert Traiter avec succès.");
			window.location = "transfert.php";
		</script>
<?php
include('../includes/connection.php');
			$zz = $_POST['id'];
			$fname = $_POST['specialite'];

		
	 			$query = 'UPDATE specialite set specialite ="'.$fname.'" WHERE
				 id_specialite ="'.$zz.'"';
					$result = mysqli_query($db, $query) or die(mysqli_error($db));
		
					
?>	
	<script type="text/javascript">
			alert("Spécialité modifiez avec succès.");
			window.location = "specialite_direct.php";
		</script>
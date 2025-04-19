<?php
include('../includes/connection.php');
			$zz = $_POST['id'];
			$fname = $_POST['filiere'];

		
	 			$query = 'UPDATE filiere set filiere ="'.$fname.'" WHERE
				 id_filiere ="'.$zz.'"';
					$result = mysqli_query($db, $query) or die(mysqli_error($db));
		
					
?>	
	<script type="text/javascript">
			alert("filiere modifiez avec succès.");
			window.location = "filiere.php";
		</script>
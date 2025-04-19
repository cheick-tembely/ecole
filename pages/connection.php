<?php
 $db = mysqli_connect('mysql-ecole-gest.alwaysdata.net', '350122_db', '76763170') or
        die ('Unable to connect. Check your connection parameters.');
        mysqli_select_db($db, 'ecole-gest_db' ) or die(mysqli_error($db));
        
?>

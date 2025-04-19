<?php
        session_start();
        if(isset($_SESSION['user'])){
            
            require_once('connexiondb.php');
            
            $id_pointage=isset($_GET['id_pointage'])?$_GET['id_pointage']:0;
            
            $etat=isset($_GET['etat'])?$_GET['etat']:0;
        
            if($etat==1)
                $newEtat=0;
            else
                $newEtat=1;

            $requete="update pointage set etat=? where id_pointage=?";
            
            $params=array($newEtat,$id_pointage);
            
            $resultat=$pdo->prepare($requete);
            
            $resultat->execute($params);
            
            header('location:pointage.php');
            
     }
?>
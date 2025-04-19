<?php
include'../includes/connection.php';

   
            ?>
             <div class="col-lg-12">
            <?php
              $n = $_POST['nom_user'];
              $p = $_POST['prenom_user'];
              $g = $_POST['GENDER'];
              $e = $_POST['email_user'];
              $user = $_POST['login'];
              $id_niveau = $_POST['id_niveau'];
           
              $pass = $_POST['password'];
              $nom_ecole = $_POST['nom_ecole'];
               
              mysqli_query($db,"INSERT INTO utilisateur
              (id_user, nom_user,prenom_user,GENDER,email_user,login,password,id_niveau,nom_ecole)
              VALUES (Null,'$n','$p','$g','$e','$user',sha1('{$pass}'),'$id_niveau','$nom_ecole')");
             
            ?>
              <script type="text/javascript">window.location = "user_admin.php";</script>
          </div>
         

<?php
include'../includes/footer.php';
?>
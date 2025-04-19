<?php
include'../includes/connection.php';
include'../includes/sidebar.php';
?><?php 

$query = 'SELECT id_user, t.niveau
FROM utilisateur u
JOIN niveau t ON t.id_niveau=u.id_niveau WHERE id_user = '.$_SESSION['MEMBER_ID'].'';
                $result = mysqli_query($db, $query) or die (mysqli_error($db));
      
                while ($row = mysqli_fetch_assoc($result)) {
                          $Aa = $row['niveau'];
                   

                                   
}   
            ?>
          <!-- Page Content -->
          <div class="col-lg-12">
            <?php
              $fname = mysqli_real_escape_string($db, $_POST['nom_envoyeur']);
              $lname = mysqli_real_escape_string($db, $_POST['prenom_envoyeur']);
              $ne = mysqli_real_escape_string($db, $_POST['poste_envoyeur']);
              $sp = mysqli_real_escape_string($db, $_POST['message']);
              $ns =mysqli_real_escape_string($db, $_POST['date_creation']);
              $n =mysqli_real_escape_string($db, $_POST['nom_ecole']);

              mysqli_query($db,"INSERT INTO message_grouper
              (id_message, nom_envoyeur,prenom_envoyeur,poste_envoyeur,message,date_creation,nom_ecole)
              VALUES (Null,'$fname','$lname','$ne','$sp','$ns','$n')");

            ?>
              <script type="text/javascript">
                window.location = "message_grouper_admin.php";
              </script>
          </div>

<?php
include'../includes/footer.php';
?>
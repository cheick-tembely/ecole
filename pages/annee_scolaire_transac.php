<?php
include '../includes/connection.php';
?>

<!-- Contenu de la page -->
<div class="col-lg-12">
    <?php
    // Vérifier s'il y a une année scolaire en cours
    $requeteAnneeEnCours = mysqli_query($db, "SELECT id_annee FROM annee_scolaire WHERE etat_annee = 'En cours'");
    
    if (mysqli_num_rows($requeteAnneeEnCours) > 0) {
        // Il y a déjà une année scolaire en cours, gérer en conséquence
        ?>
        <script type="text/javascript">alert("Impossible de creer une nouvelle anneé scolaire en cours fermer l'ancienne .");window.location = "annee_scolaire.php";</script>
        <?php	
    } else {
        // Pas d'année scolaire en cours, procéder à l'insertion d'une nouvelle
        $debutAnnee = $_POST['debut_annee'];
        $finAnnee = $_POST['fin_annee'];
        $etatAnnee = $_POST['etat_annee'];

        mysqli_query($db, "INSERT INTO annee_scolaire (id_annee, debut_annee, fin_annee, etat_annee) VALUES (NULL, '$debutAnnee', '$finAnnee', '$etatAnnee')");

        echo "<script type='text/javascript'>window.location = 'annee_scolaire.php';</script>";
    }
    ?>
</div>

<?php
include '../includes/footer.php';
?>

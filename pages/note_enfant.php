<?php
include '../includes/connection.php';
include '../includes/sidebar_parent.php';

// Vérifier si un utilisateur est connecté


// Récupérer le nom et le prénom du tuteur connecté
$nom_tuteur = $_SESSION['nom_user'];
$prenom_tuteur = $_SESSION['prenom_user'];

// Récupérer les notes des étudiants associés au tuteur connecté
$query_notes_etudiants = "SELECT e.nom, e.prenom, n.matiere, n.interrogation1,n.interrogation2,n.devoir1,n.devoir2 ,e.classe,n.total_devoirs,n.mois
                          FROM etudiant e 
                          INNER JOIN notes n ON e.id_etudiant = n.id_etudiant 
                          WHERE e.nom_tuteur = '$nom_tuteur' AND e.prenom_tuteur = '$prenom_tuteur'and e.nom_ecole = (SELECT nom_ecole FROM utilisateur WHERE nom_user = '".$_SESSION['nom_user']."' AND prenom_user = '".$_SESSION['prenom_user']."')and n.champ_visible=1 ";
$result_notes_etudiants = mysqli_query($db, $query_notes_etudiants) or die(mysqli_error($db));
?>

<div class="container">
    <h2>Notes des enfants</h2>
    <?php if (mysqli_num_rows($result_notes_etudiants) > 0) : ?>
        <div class="row">
            <div class="col-md-12">
            <div class="col-md-12">
           <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                        <tr>
                            <th>Étudiant</th>
                            <th>Classe</th>
                            <th>Matière</th>
                            <th>Interrogation 1/10</th>
                            <th>Interrogation 2/10</th>
                            <th>Devoir 1/20</th>
                            <th>Devoir 2/20</th>
                            <th>Total devoir</th>
                            <th>Mois</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row_note = mysqli_fetch_assoc($result_notes_etudiants)) : ?>
                            <tr>
                                <td><?php echo $row_note['nom'] . ' ' . $row_note['prenom']; ?></td>
                                <td><?php echo $row_note['classe']; ?></td>
                                <td><?php echo $row_note['matiere']; ?></td>
                                <td><?php echo $row_note['interrogation1']; ?></td>
                                <td><?php echo $row_note['interrogation2']; ?></td>
                                <td><?php echo $row_note['devoir1']; ?></td>
                                <td><?php echo $row_note['devoir2']; ?></td>
                                <td><?php echo $row_note['total_devoirs']; ?></td>
                                <td><?php echo $row_note['mois']; ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                    </table>
                        
                  
                        </div>
                  </div>
              </div>
    <?php else : ?>
        <p>Aucune note disponible pour les enfants associés à ce tuteur.</p>
    <?php endif; ?>
</div>

<?php
include '../includes/footer.php';
?>

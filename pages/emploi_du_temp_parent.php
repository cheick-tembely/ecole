<?php
include '../includes/connection.php';
include '../includes/sidebar_parent.php';

// Vérifier si un utilisateur est connecté

// Récupérer le nom et le prénom du tuteur connecté
$nom_tuteur = $_SESSION['nom_user'];
$prenom_tuteur = $_SESSION['prenom_user'];

// Récupérer l'emploi du temps des étudiants associés au tuteur connecté
$query_emploi_etudiants = "SELECT e.nom, e.prenom, a.id_classe,c.code_classe,m.libelle_matiere, a.jour, a.heure_debut, a.heure_fin, a.id_matiere , p.nom_professeur ,p.prenom_professeur,p.dernier_diplome
                           FROM etudiant e ,attribution a
                    
                           INNER JOIN professeur p ON a.id_professeur = p.id_professeur
                           INNER JOIN classe c ON a.id_classe = c.id_classe
                          INNER JOIN matiere m ON a.id_matiere = m.id_matiere
                           WHERE e.nom_tuteur = '$nom_tuteur' AND e.prenom_tuteur = '$prenom_tuteur'";
$result_emploi_etudiants = mysqli_query($db, $query_emploi_etudiants) or die(mysqli_error($db));
?>

<div class="container">
    <h2>Emploi du temps des enfants</h2>
    <?php if (mysqli_num_rows($result_emploi_etudiants) > 0) : ?>
        <div class="row">
            <div class="col-md-12">
           <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                        <tr>
                            <th>Étudiant</th>
                            <th>Classe</th>
                            <th>Jour</th>
                            <th>Heure de début</th>
                            <th>Heure de fin</th>
                            <th>Matière</th>
                            <th>Nom Professeur</th>
                            <th>Prenom Professeur</th>
                            <th>Dernier Diplome</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row_emploi = mysqli_fetch_assoc($result_emploi_etudiants)) : ?>
                            <tr>
                                <td><?php echo $row_emploi['nom'] . ' ' . $row_emploi['prenom']; ?></td>
                                <td><?php echo $row_emploi['code_classe']; ?></td>
                                <td><?php echo $row_emploi['jour']; ?></td>
                                <td><?php echo $row_emploi['heure_debut']; ?></td>
                                <td><?php echo $row_emploi['heure_fin']; ?></td>
                                <td><?php echo $row_emploi['libelle_matiere']; ?></td>
                                <td><?php echo $row_emploi['nom_professeur']; ?></td>
                                <td><?php echo $row_emploi['prenom_professeur']; ?></td>
                                <td><?php echo $row_emploi['dernier_diplome']; ?></td>

                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                
                </table>
                        
                  
                  </div>
            </div>
        </div>
    <?php else : ?>
        <p>Aucun emploi du temps disponible pour les enfants associés à ce tuteur.</p>
    <?php endif; ?>
</div>

<?php
include '../includes/footer.php';
?>

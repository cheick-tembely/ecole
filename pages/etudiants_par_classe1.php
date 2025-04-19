<?php
// Inclure les fichiers de connexion et l'en-tête
include '../includes/connection.php';
include '../includes/sidebar_prof.php';
$row_ecole = mysqli_fetch_assoc(mysqli_query($db, 'SELECT nom_ecole FROM utilisateur WHERE nom_user = "'.$_SESSION['nom_user'].'" AND prenom_user = "'.$_SESSION['prenom_user'].'"'));
$nom_ecole = $row_ecole['nom_ecole'];
// Vérifier si l'ID de la classe est passé dans l'URL
if (isset($_GET['classe_id'])) {
    $classe_id = $_GET['classe_id'];

    // Récupérer les informations de la classe
$query = "SELECT c.code_classe 
          FROM classe c 
          INNER JOIN utilisateur u ON c.nom_ecole = u.nom_ecole 
          WHERE c.id_classe = $classe_id 
          AND u.nom_user = '" . $_SESSION['nom_user'] . "' 
          AND u.prenom_user = '" . $_SESSION['prenom_user'] . "'";

    $result = mysqli_query($db, $query) or die(mysqli_error($db));
    $row = mysqli_fetch_assoc($result);
    
    $nom_classe = $row['code_classe'];

    // Afficher le nom de la classe
    echo '<h2>Liste des étudiants inscrits dans la classe ' . $nom_classe . '</h2>';

    // Récupérer et afficher les étudiants de la classe choisie
    $query_etudiants = "SELECT * FROM etudiant WHERE classe = '$nom_classe' AND nom_ecole = '$nom_ecole'";
    $result_etudiants = mysqli_query($db, $query_etudiants) or die(mysqli_error($db));

    echo '<div class="table-responsive">'; // Ajout de la classe table-responsive
    echo '<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>Nom</th>';
    echo '<th>Prénom</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    while ($row_etudiant = mysqli_fetch_assoc($result_etudiants)) {
        echo '<tr>';
        echo '<td>' . $row_etudiant['nom'] . '</td>';
        echo '<td>' . $row_etudiant['prenom'] . '</td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
    echo '</div>';

    // Formulaire pour envoyer les notes des étudiants
    echo '<div class="table-responsive">'; // Ajout de la classe table-responsive pour le formulaire
    echo '<form method="post" action="traitement_notes.php">';
    echo '<input type="hidden" name="id_classe" value="' . $classe_id . '">';
    echo '<label for="notes">Entrez les notes des étudiants :</label><br>';
    echo '<table class="table">'; // Ajout de la classe table pour le formulaire
    echo '<thead>';
    echo '<tr>';
    echo '<th>Étudiant</th>';
    echo '<th>Matière</th>'; // Ajout de la colonne "Matière"
    echo '<th>Interrogation 1/10</th>'; // Ajout de la colonne "Interrogation 1"
    echo '<th>Interrogation 2/10</th>'; // Ajout de la colonne "Interrogation 2"
    echo '<th>Devoir 1/20</th>'; // Ajout de la colonne "Devoir 1"
    echo '<th>Devoir 2/20</th>';
    echo '<th>Mois</th>'; // Ajout de la colonne "Devoir 2"
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    // Réinitialiser le pointeur de résultat pour afficher les étudiants dans le formulaire
    mysqli_data_seek($result_etudiants, 0);

    while ($row_etudiant = mysqli_fetch_assoc($result_etudiants)) {
        echo '<tr>';
        echo '<td>' . $row_etudiant['nom'] . ' ' . $row_etudiant['prenom'] . '</td>';
        echo '<td><input type="text" name="matiere[' . $row_etudiant['id_etudiant'] . ']" placeholder="Matière" required></td>'; // Champ pour la matière avec placeholder
        echo '<td><input type="number" name="interrogation1[' . $row_etudiant['id_etudiant'] . ']" placeholder="Interrogation 1" required></td>'; // Champ pour l'interrogation 1 avec placeholder
        echo '<td><input type="number" name="interrogation2[' . $row_etudiant['id_etudiant'] . ']" placeholder="Interrogation 2" required></td>'; // Champ pour l'interrogation 2 avec placeholder
        echo '<td><input type="number" name="devoir1[' . $row_etudiant['id_etudiant'] . ']" placeholder="Devoir 1" required></td>'; // Champ pour le devoir 1 avec placeholder
        echo '<td><input type="number" name="devoir2[' . $row_etudiant['id_etudiant'] . ']" placeholder="Devoir 2" required></td>';
        echo '<td><input type="text" name="mois[' . $row_etudiant['id_etudiant'] . ']" placeholder="Mois" required></td>'; // Champ pour le mois avec la valeur automatique
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
    echo '<input type="submit" value="Envoyer les notes">';
    echo '</form>';
    echo '</div>'; // Fermeture de la div table-responsive pour le formulaire

    // Tableau contenant toutes les informations sur les notes des étudiants
    echo '<div class="table-responsive">'; // Ajout de la classe table-responsive pour le tableau
?>
    <div class="card-header py-3">
        <h4 class="m-2 font-weight-bold text-primary">Notes des Étudiants</h4>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nom Etudiant</th>
                        <th>Prénom Etudiant</th>
                        <th>Matière</th>
                        <th>Interrogation1/10</th>
                        <th>Interrogation2/10</th>
                        <th>Devoir1/20</th>
                        <th>Devoir2/20</th>
                        <th>Total Devoir</th>
                        <th>Mois</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
$query_notes = "SELECT e.nom, e.prenom, n.matiere, n.interrogation1, n.interrogation2, n.devoir1, n.devoir2,  n.total_devoirs, n.mois  
FROM etudiant e 
INNER JOIN notes n ON e.id_etudiant = n.id_etudiant 
WHERE e.classe = '$nom_classe'
AND e.nom_ecole = (
    SELECT nom_ecole 
    FROM utilisateur 
    WHERE nom_user = '".$_SESSION['nom_user']."' 
    AND prenom_user = '".$_SESSION['prenom_user']."' 
    LIMIT 1
)";
                    $result_notes = mysqli_query($db, $query_notes) or die(mysqli_error($db));

                    while ($row_notes = mysqli_fetch_assoc($result_notes)) {
                        echo '<tr>';
                        echo '<td>' . $row_notes['nom'] . '</td>';
                        echo '<td>' . $row_notes['prenom'] . '</td>';
                        echo '<td>' . $row_notes['matiere'] . '</td>';
                        echo '<td>' . $row_notes['interrogation1'] . '</td>';
                        echo '<td>' . $row_notes['interrogation2'] . '</td>';
                        echo '<td>' . $row_notes['devoir1'] . '</td>';
                        echo '<td>' . $row_notes['devoir2'] . '</td>';
                        echo '<td>' . $row_notes['total_devoirs'] . '</td>';
                        echo '<td>' . $row_notes['mois'] . '</td>';
                        echo '</tr>';
                    }
                  }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="card-body">
        <div class="table-responsive">
            <form method="post" action="traitement_notes_examen.php">
                <input type="hidden" name="id_classe" value="<?php echo $classe_id; ?>">
                <label for="notes">Entrez les notes de Trimestre étudiants :</label><br>
                <table class="table">
                    <thead>
                        <tr>
                        <th>Étudiant</th>
                            <th>Matière</th>
                            <th>Note Classe</th>
                            <th>Examen</th>
                            <th>Mois</th>
                            <th>Trimestre</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Réinitialiser le pointeur de résultat pour afficher les étudiants dans le formulaire
                        mysqli_data_seek($result_etudiants, 0);

                        while ($row_etudiant = mysqli_fetch_assoc($result_etudiants)) {
                            echo '<tr>';
                            echo '<td>' . $row_etudiant['nom'] . ' ' . $row_etudiant['prenom'] . '</td>';
                            echo '<td><input type="text" name="matiere[' . $row_etudiant['id_etudiant'] . ']" placeholder="Matière" required></td>'; // Champ pour la matière avec placeholder
                            echo '<td><input type="number" name="total_devoir[' . $row_etudiant['id_etudiant'] . ']" placeholder="Note Classe" required></td>'; // Champ pour l'interrogation 1 avec placeholder
                            echo '<td><input type="number" name="examen[' . $row_etudiant['id_etudiant'] . ']" placeholder="Examen" required></td>'; // Champ pour l'interrogation 2 avec placeholder
                            echo '<td><input type="text" name="mois[' . $row_etudiant['id_etudiant'] . ']" placeholder="Mois" required></td>'; // Champ pour le mois avec la valeur automatique
                            echo '<td><select name="trimestre[' . $row_etudiant['id_etudiant'] . ']" required>';
                            echo '<option value="">---Choisissez une Trimestre---</option>';
                            echo '<option value="Trimestre 1">Trimestre 1</option>';
                            echo '<option value="Trimestre 2">Trimestre 2</option>';
                            echo '<option value="Trimestre 3">Trimestre 3</option>';
                            echo '</select></td>';
                            
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
                <input type="submit" value="Envoyer les notes">
            </form>
        </div>
    </div>
</div>
</div>
<?php
echo '<div class="table-responsive">'; // Ajout de la classe table-responsive pour le tableau
?>
    <div class="card-header py-3">
        <h4 class="m-2 font-weight-bold text-primary">Notes des Examen des Étudiants</h4>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nom Etudiant</th>
                        <th>Prénom Etudiant</th>
                        <th>Matière</th>
                        <th>Note Classe</th>
                        <th>Note Examen</th>
                        <th>Mois</th>
                        <th>Trimestre</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
$query_notes = "SELECT e.nom, e.prenom, n.matiere, n.total_devoir, n.examen, n.mois ,n.trimestre 
FROM etudiant e 
INNER JOIN note_examen n ON e.id_etudiant = n.id_etudiant 
WHERE e.classe = '$nom_classe'
AND e.nom_ecole = (
    SELECT nom_ecole 
    FROM utilisateur 
    WHERE nom_user = '".$_SESSION['nom_user']."' 
    AND prenom_user = '".$_SESSION['prenom_user']."'
    LIMIT 1
)";

                    $result_notes = mysqli_query($db, $query_notes) or die(mysqli_error($db));

                    while ($row_notes = mysqli_fetch_assoc($result_notes)) {
                        echo '<tr>';
                        echo '<td>' . $row_notes['nom'] . '</td>';
                        echo '<td>' . $row_notes['prenom'] . '</td>';
                        echo '<td>' . $row_notes['matiere'] . '</td>';
                        echo '<td>' . $row_notes['total_devoir'] . '</td>';
                        echo '<td>' . $row_notes['examen'] . '</td>';
                        echo '<td>' . $row_notes['mois'] . '</td>';
                        echo '<td>' . $row_notes['trimestre'] . '</td>';
                        echo '</tr>';
                    }
                  
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    </div>
<?php
// Inclure le pied de page
include '../includes/footer.php';
?>



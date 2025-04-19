<?php
include '../includes/connection.php';
include '../includes/sidebar.php';

// Chargement des données pour les sélecteurs
// Classes
$sql_classes = "SELECT DISTINCT libelle_classe, id_classe FROM classe ORDER BY id_classe ASC";
$result_classes = mysqli_query($db, $sql_classes);

$options_classes = "<select class='form-control' name='id_classe' required>
    <option value='' disabled selected hidden>Selectionnez la classe</option>";
while ($row = mysqli_fetch_assoc($result_classes)) {
    $options_classes .= "<option value='".$row['id_classe']."'>".$row['libelle_classe']."</option>";
}
$options_classes .= "</select>";

// Matières
$sql_matieres = "SELECT DISTINCT libelle_matiere, id_matiere FROM matiere ORDER BY id_matiere ASC";
$result_matieres = mysqli_query($db, $sql_matieres);

$options_matieres = "<select class='form-control' name='id_matiere' required>
    <option value='' disabled selected hidden>Selectionnez la matiere</option>";
while ($row = mysqli_fetch_assoc($result_matieres)) {
    $options_matieres .= "<option value='".$row['id_matiere']."'>".$row['libelle_matiere']."</option>";
}
$options_matieres .= "</select>";

// Professeurs
$sql_profs = "SELECT DISTINCT nom_professeur, prenom_professeur, id_professeur FROM professeur ORDER BY id_professeur ASC";
$result_profs = mysqli_query($db, $sql_profs);

$options_profs = "<select class='form-control' name='id_professeur' required>
    <option value='' disabled selected hidden>Selectionnez le professeur</option>";
while ($row = mysqli_fetch_assoc($result_profs)) {
    $options_profs .= "<option value='".$row['id_professeur']."'>".$row['nom_professeur'].' '.$row['prenom_professeur']."</option>";
}
$options_profs .= "</select>";

// Ecole de l'utilisateur
$ecole_query = 'SELECT nom_ecole FROM ecole WHERE nom = "'.$_SESSION['nom_user'].'" AND prenom = "'.$_SESSION['prenom_user'].'"';
$row_ecole = mysqli_fetch_assoc(mysqli_query($db, $ecole_query));
$nom_ecole = $row_ecole['nom_ecole'] ?? 'Non défini';
?>

<!-- Lien vers Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Script Bootstrap Bundle (inclut Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h4 class="m-2 font-weight-bold text-primary">Attribution des cours
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AttriModal">
                <i class="fas fa-fw fa-plus"></i>
            </button>
        </h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Classe</th>
                        <th>Matière</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Jour</th>
                        <th>Début</th>
                        <th>Fin</th>
                        <th>Volume/Semaine</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $query = 'SELECT at.id_attribution, m.id_matiere,m.libelle_matiere, p.id_professeur, p.nom_professeur, p.prenom_professeur, c.id_classe,c.libelle_classe, at.jour, at.heure_debut, at.heure_fin, at.volume  
                          FROM attribution at, professeur p, matiere m, classe c
                          WHERE at.id_professeur = p.id_professeur 
                          and at.id_matiere=m.id_matiere
                          and at.id_classe=c.id_classe
                          AND at.nom_ecole = "'.$nom_ecole.'"
                          AND at.champ_visible = 1';
                $result = mysqli_query($db, $query) or die (mysqli_error($db));

                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>';
                    echo '<td>'.$row['libelle_classe'].'</td>';
                    echo '<td>'.$row['libelle_matiere'].'</td>';
                    echo '<td>'.$row['nom_professeur'].'</td>';
                    echo '<td>'.$row['prenom_professeur'].'</td>';
                    echo '<td>'.$row['jour'].'</td>';
                    echo '<td>'.$row['heure_debut'].'</td>';
                    echo '<td>'.$row['heure_fin'].'</td>';
                    echo '<td>'.$row['volume'].'</td>';
                    echo '<td align="right"> 
                        
                    </td>';
                    echo '</tr>';
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="AttriModal" tabindex="-1" aria-labelledby="AttriModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="AttriModalLabel">Attribution des cours</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="attri_transac1.php?action=add">
                    <div class="form-group mb-3">
                        <?php echo $options_classes; ?>
                    </div>
                    <div class="form-group mb-3">
                        <?php echo $options_matieres; ?>
                    </div>
                    <div class="form-group mb-3">
                        <?php echo $options_profs; ?>
                    </div>
                    <div class="form-group mb-3">
                        <input class="form-control" placeholder="Jour" name="jour" required>
                    </div>
                    <div class="form-group mb-3">
                        <input type="time" class="form-control" placeholder="Heure Début" name="heure_debut" required>
                    </div>
                    <div class="form-group mb-3">
                        <input type="time" class="form-control" placeholder="Heure Fin" name="heure_fin" required>
                    </div>
                    <div class="form-group mb-3">
                        <input type="number" max="40" class="form-control" placeholder="Volume" name="volume" required>
                    </div>
                    <div class="form-group mb-3">
                        <input class="form-control" placeholder="Ecole" name="nom_ecole" value="<?php echo $nom_ecole; ?>" readonly>
                    </div>
                    <button type="submit" class="btn btn-success"><i class="fa fa-check fa-fw"></i>Attribuer</button>
                    <button type="reset" class="btn btn-danger"><i class="fa fa-times fa-fw"></i>Effacer</button>
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Annuler</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include '../includes/footer.php'; ?>
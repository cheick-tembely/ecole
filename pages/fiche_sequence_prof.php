<?php
include '../includes/connection.php';
include '../includes/sidebar_prof.php';
?>

<?php
// Requête pour récupérer le nom de l'école
$row_ecole = mysqli_fetch_assoc(mysqli_query($db, 'SELECT nom_ecole FROM utilisateur WHERE nom_user = "'.$_SESSION['nom_user'].'" AND prenom_user = "'.$_SESSION['prenom_user'].'"'));
$nom_ecole = $row_ecole['nom_ecole'];

// Liste des classes
$sqlforjob = "SELECT DISTINCT libelle_classe, id_classe FROM classe ORDER BY id_classe ASC";
$result = mysqli_query($db, $sqlforjob);
$id_classe = "<select class='form-control' name='id_classe' required>
        <option value='' disabled selected hidden>Selectionnez la classe</option>";
while ($row = mysqli_fetch_assoc($result)) {
    $id_classe .= "<option value='".$row['id_classe']."'>".$row['libelle_classe']."</option>";
}
$id_classe .= "</select>";

// Liste des matières
$sqlforjob = "SELECT DISTINCT libelle_matiere, id_matiere FROM matiere ORDER BY id_matiere ASC";
$result = mysqli_query($db, $sqlforjob);
$id_matiere = "<select class='form-control' name='id_matiere' required>
        <option value='' disabled selected hidden>Selectionnez la matiere</option>";
while ($row = mysqli_fetch_assoc($result)) {
    $id_matiere .= "<option value='".$row['id_matiere']."'>".$row['libelle_matiere']."</option>";
}
$id_matiere .= "</select>";

// Liste des professeurs
$sqlforjob = "SELECT DISTINCT nom_professeur, prenom_professeur, id_professeur FROM professeur ORDER BY id_professeur ASC";
$result = mysqli_query($db, $sqlforjob);
$id_professeur = "<select class='form-control' name='id_professeur' required>
        <option value='' disabled selected hidden>Selectionnez le professeur</option>";
while ($row = mysqli_fetch_assoc($result)) {
    $id_professeur .= "<option value='".$row['id_professeur']."'>".$row['nom_professeur'].' '.$row['prenom_professeur']."</option>";
}
$id_professeur .= "</select>";
?>

<?php 
$query = 'SELECT id_user, t.niveau FROM utilisateur u JOIN niveau t ON t.id_niveau=u.id_niveau WHERE id_user = '.$_SESSION['MEMBER_ID']; 
$result = mysqli_query($db, $query);

while ($row = mysqli_fetch_assoc($result)) {
    $Aa = $row['niveau'];
    if ($Aa == 'User') {
        echo "<script type='text/javascript'>
                alert('Restricted Page! You will be redirected to POS');
                window.location = 'pos.php';
              </script>";
    }
}   
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/@mdi/font/css/materialdesignicons.min.css" rel="stylesheet">

<!-- Flag Icons (CDN) -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.6.0/css/flag-icon.min.css" rel="stylesheet">
</head>
<body>
  
</body>
</html>
<!-- Material Design Icons (CDN) -->


<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h4 class="m-2 font-weight-bold text-primary">
            Fiche de séquence&nbsp;
            <a href="#" class="btn btn-primary bg-gradient-primary" data-toggle="modal" data-target="#aModal"><i class="fas fa-fw fa-plus"></i></a>
        </h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">        
                <thead>
                    <tr>
                        <th>Classe</th>
                        <th>Matière</th>
                        <th>Durée</th>
                        <th>Nom</th>
                        <th>Prenom</th>
                        <th>Domaine</th>
                        <th>Compétence</th>
                        <th>Titre</th>
                        <th>Activité</th>
                        <th>Année Scolaire</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = 'SELECT at.id_fiche, m.id_matiere, m.libelle_matiere, p.id_professeur, p.nom_professeur, p.prenom_professeur, c.id_classe, c.code_classe, at.domaine, at.competence, at.annee_scolaire, at.titre, at.activite, at.duree  
                    FROM fiche_sequence AS at
                    JOIN classe AS c ON at.id_classe = c.id_classe
                    JOIN matiere AS m ON at.id_matiere = m.id_matiere
                    JOIN professeur AS p ON at.id_professeur = p.id_professeur
                    WHERE at.nom_ecole = (
                        SELECT nom_ecole 
                        FROM utilisateur 
                        WHERE nom_user = "'.$_SESSION['nom_user'].'" 
                        AND prenom_user = "'.$_SESSION['prenom_user'].'"
                        LIMIT 1
                    )';
                    $result = mysqli_query($db, $query);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>';
                        echo '<td>'. $row['code_classe'].'</td>';
                        echo '<td>'. $row['libelle_matiere'].'</td>';
                        echo '<td>'. $row['duree'].'</td>';
                        echo '<td>'. $row['nom_professeur'].'</td>';
                        echo '<td>'. $row['prenom_professeur'].'</td>';
                        echo '<td>'. $row['domaine'].'</td>';
                        echo '<td>'. $row['competence'].'</td>';
                        echo '<td>'. $row['titre'].'</td>';
                        echo '<td>'. $row['activite'].'</td>';
                        echo '<td>'. $row['annee_scolaire'].'</td>';
                        echo '<td align="right"> 
                            <div class="btn-group">
                                <a type="button" class="btn btn-primary bg-gradient-primary" href="fiche_sequence_prof_searchfrm.php?action=edit&id='.$row['id_fiche'].'"><i class="fas fa-fw fa-list-alt"></i> Details</a>
                            </div> 
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
<!-- Modal -->
<div class="modal fade" id="aModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ajouter une fiche de séquence</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="fiche_sequence_prof_transac.php?action=add">
                    <div class="form-group">
                        <?php echo $id_classe; ?>
                    </div>
                    <div class="form-group">
                        <?php echo $id_matiere; ?>
                    </div>
                    <div class="form-group">
                        <?php echo $id_professeur; ?>
                    </div>
                    <div class="form-group">
                        <input class="form-control" name="duree" placeholder="Durée" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" name="domaine" placeholder="Domaine" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" name="competence" placeholder="Compétence" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" name="titre" placeholder="Titre" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" name="activite" placeholder="Activité" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" name="annee_scolaire" placeholder="Année Scolaire" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" name="nom_ecole" value="<?php echo $nom_ecole; ?>" readonly>
                    </div>
                    <button type="submit" class="btn btn-success"><i class="fa fa-check fa-fw"></i>Attribuer</button>
                    <button type="reset" class="btn btn-danger"><i class="fa fa-times fa-fw"></i>Effacer</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>  
                </form>  
            </div>
        </div>
    </div>
</div>

<!-- jQuery, Popper.js, and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<?php
include '../includes/footer.php';
?>
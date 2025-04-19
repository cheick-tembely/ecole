<?php
include '../includes/connection.php';
include '../includes/sidebar_prof.php';

// Récupérer l'ID de l'utilisateur connecté à partir de la session
$idUtilisateur = $_SESSION['MEMBER_ID'];

// Récupérer les informations sur la matière et la classe du professeur à partir de la table emploi

// Vérifier si des résultats ont été retournés

?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h4 class="m-2 font-weight-bold text-primary">Enregistrez une absence&nbsp;<a href="#" data-toggle="modal" data-target="#absenceProfModal" type="button" class="btn btn-primary bg-gradient-primary" style="border-radius: 0px;"><i class="fas fa-fw fa-plus"></i></a></h4>
    </div>
    <div class="card-header py-3">
        <h4 class="m-2 font-weight-bold text-primary">Exportez la liste des absences&nbsp;<a href="fonction_csv.php" type="button" class="btn btn-primary bg-gradient-primary" style="border-radius: 0px;"><i class="fa fa-file-excel"></i></a></h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">        
                <thead>
                    <tr>
                        <th>Nom du Prof</th>
                        <th>Prenom du prof</th>
                        <th>Nom Etudiant</th>
                        <th>Prenom Etudiant</th>
                        <th>Classe</th>
                        <th>Matiere</th>
                        <th>Date</th>
                        <th>Justifier</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php                  
$query = "SELECT distinct a.*, u.nom_user, u.prenom_user FROM absence a 
          JOIN utilisateur u ON a.nom_ecole = u.nom_ecole 
          WHERE u.nom_user = '".$_SESSION['nom_user']."' AND u.prenom_user = '".$_SESSION['prenom_user']."' 
          ORDER BY a.id_absence DESC";
                    $result = mysqli_query($db, $query) or die (mysqli_error($db));
                    $row_ecole = mysqli_fetch_assoc(mysqli_query($db, 'SELECT nom_ecole FROM utilisateur WHERE nom_user = "'.$_SESSION['nom_user'].'" AND prenom_user = "'.$_SESSION['prenom_user'].'"'));
                    $nom_ecole = $row_ecole['nom_ecole'];
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>';
                        echo '<td>'. $row['nom_user'] .'</td>'; // Afficher le nom du professeur
                        echo '<td>'. $row['prenom_user'] .'</td>'; // Afficher le prénom du professeur
                        echo '<td>'. $row['nom_etudiant'].'</td>';
                        echo '<td>'. $row['prenom_etudiant'].'</td>';
                        echo '<td>'. $row['classe'].'</td>'; // Afficher la classe du professeur
                        echo '<td>'. $row['matiere'].'</td>'; // Afficher la matière du professeur
                        echo '<td>'. $row['dates'].'</td>';
                        echo '<td>'. $row['justifier'].'</td>';
                        
                        // Compter le nombre d'occurrences du nom de l'étudiant
                        $nomEtudiant = $row['nom_etudiant'];
                        $queryCount = "SELECT COUNT(*) as count FROM absence WHERE nom_etudiant = '$nomEtudiant'";
                        $resultCount = mysqli_query($db, $queryCount);
                        $rowCount = mysqli_fetch_assoc($resultCount);
                        $count = $rowCount['count'];
                        
                        // Appliquer le style CSS si le nombre d'occurrences dépasse trois
                        if ($count >= 3 ) {
                            echo '<td align="right" style="color: red;">';
                        } else {
                            echo '<td align="right">';
                        }
                        
                        echo '<div class="btn-group">
                                  <a type="button" class="btn btn-primary bg-gradient-primary" href="absence_searchfrm.php?action=edit&id='.$row['id_absence'].'"><i class="fas fa-fw fa-list-alt"></i> Details</a>
                              </div>
                              <div class="btn-group">
                                  <a type="button" class="btn btn-primary bg-gradient-primary dropdown no-arrow" data-toggle="dropdown" style="color:white;">
                                      ... <span class="caret"></span>
                                  </a>
                                  <ul class="dropdown-menu text-center" role="menu">
                                      <li>
                                          <a type="button" class="btn btn-warning bg-gradient-warning btn-block" style="border-radius: 0px;" href="absence_edit.php?action=edit&id='.$row['id_absence'].'">
                                              <i class="fas fa-fw fa-edit"></i> Modifiez
                                          </a>
                                      </li>
                                  </ul>
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

<script type="text/javascript">
    function confirmBlock(id_absence) {
        var confirmBlock = confirm("Voulez-vous vraiment supprimer ce absence ?");
        if (confirmBlock) {
            window.location.href = "absence_del.php?id=" + id_absence;
        }
    }
</script>

<div class="modal fade" id="absenceProfModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Enregistrez une Absence</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" method="post" action="absence_transac.php?action=add">
                    <form role="form" method="post" action="">
                        <div class="form-group">
                            <input class="form-control" placeholder="Nom Professeur" name="nom" value="<?php echo $_SESSION['nom_user']; ?>" required readonly>
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Prenom Professeur" name="prenom" value="<?php echo $_SESSION['prenom_user']; ?>" required readonly>
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Nom Etudiant" name="nom_etudiant" required>
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Prenom Etudiant" name="prenom_etudiant" required>
                        </div>
                        <div class="form-group">
                        <input class="form-control" placeholder="Classe" name="classe" required>
                        </div>
                        <div class="form-group">
                        <input class="form-control" placeholder="Matiere" name="matiere" required>
                        </div>
                        <div class="form-group">
                            <input type="datetime-local" class="form-control" placeholder="Date" name="dates" value="<?php echo date('Y-m-d\TH:i'); ?>" required>
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Justifier oui ou non" name="justifier" required>
                        </div>
                        <div class="form-group">
    <input class="form-control" placeholder="Ecole" name="nom_ecole" value="<?php echo $nom_ecole; ?>" required readonly>
</div>
                        <hr>
                        <button type="submit" class="btn btn-success"><i class="fa fa-check fa-fw"></i>Envoyez</button>
                        <button type="reset" class="btn btn-danger"><i class="fa fa-times fa-fw"></i>Effacez</button>
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Annulez</button>   
                    </form>  
                </form>
            </div>
        </div>
    </div>
</div>

<?php
include '../includes/footer.php';
?>

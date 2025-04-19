<?php
// Inclure le fichier de connexion à la base de données
include '../includes/connection.php';
include '../includes/sidebar_compt.php';
$row_ecole = mysqli_fetch_assoc(mysqli_query($db, 'SELECT nom_ecole FROM utilisateur WHERE nom_user = "'.$_SESSION['nom_user'].'" AND prenom_user = "'.$_SESSION['prenom_user'].'"'));
$nom_ecole = $row_ecole['nom_ecole'];
// Vérifier si l'identifiant de l'étudiant est passé en paramètre
if(isset($_GET['id'])) {
    $id_etudiant = $_GET['id'];

    // Vérifier si le formulaire a été soumis pour enregistrer les frais de scolarité et les paiements mensuels
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["frais_inscription"])) {
        $frais_inscription = $_POST["frais_inscription"];
        $paiement_type = $_POST["paiement_type"];
        $mois_paye = $_POST["mois_paye"];
        $montant_annuel = isset($_POST["montant_annuel"]) ? $_POST["montant_annuel"] : null;
        $nom_ecole = isset($_POST["nom_ecole"]);
        // Préparer et exécuter la requête d'insertion dans la table 'scolarite'
        $insert_query = $db->prepare("INSERT INTO scolarite (id_etudiant, frais_inscription, paiement_type, mois_paye, montant_annuel,nom_ecole) VALUES (?, ?, ?, ?, ?, ?)");
        
        if ($insert_query) {
            $insert_query->bind_param("idssss", $id_etudiant, $frais_inscription, $paiement_type, $mois_paye, $montant_annuel,$nom_ecole);
            $insert_query->execute();

            echo '<div class="container">';
            echo '<p>Les frais de scolarité et le paiement ont été enregistrés avec succès pour l\'étudiant.</p>';
            echo '</div>';

            $insert_query->close();
        } else {
            echo '<div class="container">';
            echo '<p>Erreur lors de l\'enregistrement des frais de scolarité et du paiement : ' . $db->error . '</p>';
            echo '</div>';
        }
    }
}

// Récupérer les données des étudiants pour les afficher dans les tableaux
$annuel_query = $db->query("SELECT e.nom, e.prenom, e.classe, s.frais_inscription, s.montant_annuel 
                            FROM etudiant e 
                            JOIN scolarite s ON e.id_etudiant = s.id_etudiant 
                            WHERE s.paiement_type = 'annuel' 
                            AND s.nom_ecole = (SELECT nom_ecole FROM utilisateur 
                                               WHERE nom_user = '".$_SESSION['nom_user']."' 
                                               AND prenom_user = '".$_SESSION['prenom_user']."' 
                                               LIMIT 1) 
                            AND e.champ_visible=1");
                          

$tranche_query = $db->query("SELECT e.nom, e.prenom, e.classe, s.frais_inscription, s.montant_annuel 
FROM etudiant e 
JOIN scolarite s ON e.id_etudiant = s.id_etudiant 
WHERE s.paiement_type = 'tranche' 
AND s.nom_ecole = (SELECT nom_ecole FROM utilisateur 
                   WHERE nom_user = '".$_SESSION['nom_user']."' 
                   AND prenom_user = '".$_SESSION['prenom_user']."' 
                   LIMIT 1) 
AND e.champ_visible=1");

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enregistrement des frais de scolarité</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }
        h1, h2, p {
            text-align: center;
        }
        form {
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"], input[type="number"], input[type="submit"], select {
            width: 100%;
            padding: 8px;
            border-radius: 3px;
            border: 1px solid #ccc;
            margin-bottom: 10px;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Enregistrement des frais de scolarité</h1>
    <div class="container">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . '?id=' . $id_etudiant); ?>" method="POST">
            <label for="frais_inscription">Frais d'inscription :</label>
            <input type="number" id="frais_inscription" name="frais_inscription" required>
            <label for="paiement_type">Type de paiement :</label>
            <select id="paiement_type" name="paiement_type" required onchange="showFields()">
                <option value="annuel">Paiement annuel</option>
                <option value="tranche">Paiement par tranche</option>
            </select>
            <div id="montantAnnuelDiv" style="display: none;">
                <label for="montant_annuel">Montant annuel :</label>
                <input type="number" id="montant_annuel" name="montant_annuel">
            </div>
            <div id="moisPayeDiv" style="display: none;">
                <label for="mois_paye">Mois payé :</label>
                <select id="mois_paye" name="mois_paye" required>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <!-- Ajoutez d'autres options pour les mois suivants -->
                </select>
            </div>
            <div class="form-group">
    <input class="form-control" placeholder="Ecole" name="nom_ecole" value="<?php echo $nom_ecole; ?>" required readonly>
</div>
            <input type="submit" value="Enregistrer">
        </form>
    </div>
    <script>
        function showFields() {
            var paiementType = document.getElementById("paiement_type").value;
            var montantAnnuelDiv = document.getElementById("montantAnnuelDiv");
            var moisPayeDiv = document.getElementById("moisPayeDiv");

            if (paiementType === "annuel") {
                montantAnnuelDiv.style.display = "block";
                moisPayeDiv.style.display = "none";
            } else if (paiementType === "tranche") {
                montantAnnuelDiv.style.display = "none";
                moisPayeDiv.style.display = "block";
            } else {
                montantAnnuelDiv.style.display = "none";
                moisPayeDiv.style.display = "none";
            }
        }
    </script>



</body>
</html>
<?php
include'../includes/footer.php';
?>
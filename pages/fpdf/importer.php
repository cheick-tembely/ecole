<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["fileToUpload"])) {
    $targetDir = "uploads/"; // Répertoire cible où vous souhaitez enregistrer les fichiers importés
    $targetFile = $targetDir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $pdfFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Vérifie si le fichier est un PDF
    if ($pdfFileType != "pdf") {
        echo "Désolé, seuls les fichiers PDF sont autorisés.";
        $uploadOk = 0;
    }

    // Vérifie si $uploadOk est défini à 0 par une erreur
    if ($uploadOk == 0) {
        echo "Désolé, votre fichier n'a pas été importé.";

    // Importe le fichier si tout est OK
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
            // Lecture du contenu du fichier PDF
            $pdfContent = file_get_contents($targetFile);

            // Utilisation de FPDF pour afficher le contenu dans un nouveau PDF
            require('fpdf.php');

            // Création d'une instance de FPDF
            $pdf = new FPDF();
            $pdf->AddPage();
            $pdf->SetFont('Arial','',12);

            // Ajout du contenu PDF
            $pdf->MultiCell(0,10, $pdfContent);

            // Affichage du PDF à l'écran
            $pdf->Output();

        } else {
            echo "Une erreur s'est produite lors de l'importation de votre fichier.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<body>

<form action="" method="post" enctype="multipart/form-data">
    Sélectionnez un fichier PDF à importer :
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Importer le fichier" name="submit">
</form>

</body>
</html>

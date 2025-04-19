<?php
require_once 'dompdf/autoload.inc.php'; // Inclure l'autoloader de DOMPDF

use Dompdf\Dompdf;

// Créer une nouvelle instance de Dompdf
$dompdf = new Dompdf();

// Contenu HTML à convertir en PDF
$html = '
<!DOCTYPE html>
<html>
<head>
    <title>Exemple de PDF avec DOMPDF</title>
</head>
<body>
    <h1>Exemple de PDF avec DOMPDF</h1>
    <p>Ceci est un exemple de contenu HTML à convertir en PDF.</p>
</body>
</html>
';

// Charger le contenu HTML dans DOMPDF
$dompdf->loadHtml($html);

// Rendre le PDF
$dompdf->render();

// Générer le PDF (vous pouvez utiliser 'stream' pour afficher le PDF dans le navigateur ou 'save' pour enregistrer le PDF sur le serveur)
$dompdf->stream("exemple_pdf_dompdf.pdf");

?>

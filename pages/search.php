<?php
// Clé API OpenCage
$apiKey = '59a0512d1c5e4acaacca20b52ead3cb0';

$lieu = null;
$latitude = null;
$longitude = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom_lieu = urlencode($_POST['nom_lieu']);
    $apiUrl = "https://api.opencagedata.com/geocode/v1/json?q={$nom_lieu}&key={$apiKey}";

    // Appel de l'API OpenCage
    $response = file_get_contents($apiUrl);
    $data = json_decode($response, true);

    if ($data['total_results'] > 0) {
        $lieu = $data['results'][0]['formatted'];
        $latitude = $data['results'][0]['geometry']['lat'];
        $longitude = $data['results'][0]['geometry']['lng'];
    } else {
        echo "<script>alert('Aucun résultat trouvé');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Résultats de la recherche</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-top: 20px;
        }
        h1 {
            color: #333;
        }
        .results {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            width: 90%;
            max-width: 600px;
        }
        #map {
            height: 400px;
            width: 100%;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <h1>Résultats de la recherche</h1>
    <?php if ($lieu): ?>
        <div class="results">
            <p><strong>Nom:</strong> <?php echo htmlspecialchars($_POST['nom_lieu']); ?></p>
            <p><strong>Adresse:</strong> <?php echo $lieu; ?></p>
            <p><strong>Latitude:</strong> <?php echo $latitude; ?></p>
            <p><strong>Longitude:</strong> <?php echo $longitude; ?></p>
        </div>
        <div id="map"></div>
        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
        <script>
            var map = L.map('map').setView([<?php echo $latitude; ?>, <?php echo $longitude; ?>], 13);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);
            L.marker([<?php echo $latitude; ?>, <?php echo $longitude; ?>]).addTo(map)
                .bindPopup('<?php echo $lieu; ?>')
                .openPopup();
        </script>
    <?php else: ?>
        <p>Aucun résultat trouvé</p>
    <?php endif; ?>
</body>
</html>

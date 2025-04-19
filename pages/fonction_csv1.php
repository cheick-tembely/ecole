<?php

try{
    $PDO=new PDO('mysql:host=localhost;dbname=ecole-gest','root','');
    $PDO->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
    $PDO->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
}catch(PDOException $e){
    echo'erreur';
}
$req=$PDO->prepare('select nom,prenom,telephone,nom_tuteur,prenom_tuteur,telephone_tuteur,classe from etudiant');
$req->execute();
$data=$req->fetchAll();
$datas=array();
foreach($data as $d){
    $datas[]=array(
'Nom'=>$d->nom,
'Prenom'=>$d->prenom,
'Telephone'=>$d->telephone,
'Nom du Tuteur'=>$d->nom_tuteur,
'Prenom du Tuteur'=>$d->prenom_tuteur,
'Classe'=>$d->classe,

    );
}



class CsvExporter {
    public static function export($datas, $filename = "Export_liste_des_etudiants.csv") {
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        
        $file = fopen('php://output', 'w');

        // Write the header
        fputcsv($file, array_keys($datas[0]), ';');

        // Write the data
        foreach ($datas as $data) {
            fputcsv($file, $data, ';');
        }

        fclose($file);
    }
}

// Exemple d'utilisation


CsvExporter::export($datas);
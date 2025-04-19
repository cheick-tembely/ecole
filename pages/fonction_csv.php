<?php

try{
    $PDO=new PDO('mysql:host=localhost;dbname=ecole-gest','root','');
    $PDO->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
    $PDO->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
}catch(PDOException $e){
    echo'erreur';
}
$req=$PDO->prepare('select nom,prenom,nom_etudiant,prenom_etudiant,classe,matiere,justifier from absence');
$req->execute();
$data=$req->fetchAll();
$datas=array();
foreach($data as $d){
    $datas[]=array(
'Nom Professeur'=>$d->nom,
'Prenom Professeur'=>$d->prenom,
'Nom Etudiant'=>$d->nom_etudiant,
'Prenom Etudiant'=>$d->prenom_etudiant,
'Classe'=>$d->classe,
'Matiere'=>$d->matiere,
'Justifier'=>$d->justifier,
    );
}



class CsvExporter {
    public static function export($datas, $filename = "Export_liste_des_absences.csv") {
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
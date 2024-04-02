<?php
require_once 'D:/Android/Quran/net.sunnite.quran.warsh/yacin_jazairi/getID3-master/getid3/getid3.php';

$dossiers = array_filter(glob(__DIR__ . '/All/*'), 'is_dir');
$mp3List = [];

foreach ($dossiers as $dossier) {
    // Obtenir la liste des fichiers MP3 dans ce dossier
    $mp3Files = glob($dossier . "/*.mp3");

    foreach ($mp3Files as $mp3File) {
        // Diviser le chemin en segments
        $folderSegments = explode(DIRECTORY_SEPARATOR, rtrim($mp3File, DIRECTORY_SEPARATOR));

        // Récupérer les deux derniers segments
        $subdirectories = implode(DIRECTORY_SEPARATOR, array_slice($folderSegments, -3));

        // Obtenir le nom du fichier sans extension
        $pathinfo = pathinfo($mp3File, PATHINFO_FILENAME);

        // Vérifier si le nom de fichier n'est pas un entier
        if (!is_numeric($pathinfo)) {
            $mp3List[] = $subdirectories;
            // echo "Dossier : $subdirectories  | Nom du fichier : $pathinfo\n";
        }
    }
}

foreach($mp3List as $mp3File){
    echo $mp3File . "\n";
}
echo count($mp3List);

$getID3 = new getID3;

/*$fileInfo = $getID3->analyze($in_mp3file);

// Get various information about the MP3 file
echo 'Title: ' . $fileInfo['tags']['id3v2']['title'][0] . "\n";
echo 'Artist: ' . $fileInfo['tags']['id3v2']['artist'][0] . "\n";
echo 'Album: ' . $fileInfo['tags']['id3v2']['album'][0] . "\n";
echo 'Duration: ' . $fileInfo['playtime_string'] . "\n";
*/



$mp3File = 'D:\Android\Quran\Nouveau dossier\surah_audio\Yassine_El-Jazaery\exporter\All\25\41.mp3';

















?>
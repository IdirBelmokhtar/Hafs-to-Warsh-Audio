<?php
// Obtenir la liste des dossiers dans le dossier principal
$dossiers = array_filter(glob(__DIR__ . '/All/*'), 'is_dir');
// Parcourir chaque dossier
# Merge { # with # (2) }
foreach ($dossiers as $dossier) {
    // Obtenir la liste des fichiers MP3 dans ce dossier
    $mp3Files = glob($dossier . "/*.mp3");

    // Parcourir chaque fichier MP3 dans le dossier
    foreach ($mp3Files as $mp3File) {
        // Diviser le chemin en segments
        $folderSegments = explode(DIRECTORY_SEPARATOR, rtrim($mp3File, DIRECTORY_SEPARATOR));

        // Récupérer les deux derniers segments
        $subdirectories = implode(DIRECTORY_SEPARATOR, array_slice($folderSegments, -3));

        // Obtenir le nom du fichier sans extension
        $pathinfo = pathinfo($mp3File, PATHINFO_FILENAME);

        // Vérifier si le nom de fichier n'est pas un entier
        if (!is_numeric($pathinfo)) {


            # Merger
            // Merge { # with # (2) }
            list($a, $b) = explode(' (2)', $pathinfo);
            // list($a, $b) = explode(' (2)', $pathinfo);
            echo $a;


            $mp3File_ = $dossier . "/" . $a . ".mp3";
            $mp3File_2 = $dossier . "/" . $a . " (2).mp3";
            //$mp3File_3 = $dossier . "/" . $a . " (3).mp3";

            $merged = "";
            $merged .= file_get_contents($mp3File_);
            $merged .= file_get_contents($mp3File_2);
            //$merged .= file_get_contents($mp3File_3);

            // Obtenir le nom du premier fichier MP3
            $outputFileName = $a;

            // Enregistrer le fichier fusionné
            file_put_contents($dossier . "/" . $outputFileName . ".mp3", $merged);
            # echo "Les fichiers ont été fusionnés avec succès dans " . $folderPath . "/" . $outputFileName . ".mp3";

            // Supprimer le dernier fichier MP3 fusionné
            $lastMergedMP3 = $mp3File_2;
            unlink($lastMergedMP3);
            # echo "Le dernier fichier MP3 fusionné a été supprimé : ".$mp3File_2;


        }
    }
}
echo "Part 1 merged with success! => merge (2) with parent.\n";

# Merge { # with # (3) }
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


            # Merger
            // Merge { # with # (3) }
            list($a, $b) = explode(' (3)', $pathinfo);
            echo $a;


            $mp3File_ = $dossier . "/" . $a . ".mp3";
            $mp3File_3 = $dossier . "/" . $a . " (3).mp3";

            $merged = "";
            $merged .= file_get_contents($mp3File_);
            $merged .= file_get_contents($mp3File_3);

            // Obtenir le nom du premier fichier MP3
            $outputFileName = $a;

            // Enregistrer le fichier fusionné
            file_put_contents($dossier . "/" . $outputFileName . ".mp3", $merged);
            # echo "Les fichiers ont été fusionnés avec succès dans " . $folderPath . "/" . $outputFileName . ".mp3";

            // Supprimer le dernier fichier MP3 fusionné
            $lastMergedMP3 = $mp3File_3;
            unlink($lastMergedMP3);
            # echo "Le dernier fichier MP3 fusionné a été supprimé : ".$mp3File_2;


        }
    }
}
echo "Part 2 merged with success! => merge (3) with parent.\n";

// Clear the terminal
if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
    // For Windows
    system('cls');
}  else {
    // For Linux and macOS
    system('clear');
}
echo "\n\n-----------------------------------------------------COMPLETED-----------------------------------------------------\n\n";
# Show files need to cut
print("\n\nWARNING : You need to cut all this files manual :\n");
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
            echo "Dossier : $subdirectories  | Nom du fichier : $pathinfo\n";
        }
    }
}

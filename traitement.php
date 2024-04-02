<?php
// Récupérer les données du formulaire
$input_file = $_POST['input_file'];
$start_time = $_POST['start_time'];
$end_time = $_POST['end_time'];
$name_part_a = $_POST['name_part_a'];
$name_part_b = $_POST['name_part_b'];

$chemin = '';

$pattern = '/\/(\d+)\//'; // Expression régulière pour rechercher le premier groupe de chiffres entre deux barres obliques
if (preg_match($pattern, $input_file, $matches)) {
    $number = $matches[1]; // Le premier groupe de chiffres correspondants
    $chemin = strval(__DIR__ . '/All/' . $number . '/');
} else {
    echo "Aucun chiffre trouvé dans le chemin du fichier.";
}

// Escaping special characters in the file path
$input_file_escaped = escapeshellarg($input_file);
// echo "input_file : $input_file start_time :$start_time end_time : $end_time\n";

// Execute the ffmpeg commands
exec("ffmpeg -i $input_file_escaped -ss 0 -to $start_time -c copy \"{$chemin}{$name_part_a}.mp3\"");
exec("ffmpeg -i $input_file_escaped -ss $start_time -to $end_time -c copy \"{$chemin}{$name_part_b}.mp3\"");


// supprimer l'ancien fichier mp3 #-#.mp3
$filename = basename($input_file);
unlink($chemin . $filename);

echo "Le fichier MP3 ($filename) a été découpé en deux partie ($name_part_a.mp3) et ($name_part_b.mp3) avec succès.";
?>

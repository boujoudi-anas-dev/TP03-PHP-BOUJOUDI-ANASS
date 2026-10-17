<?php

const NOTE_MIN = 0;
const NOTE_MAX = 20;

// 1. Vérifier l'existence des champs
if (
    !isset($_POST["nom"]) ||
    !isset($_POST["note_info"]) ||
    !isset($_POST["note_math"])
) {
    exit("Erreur : tous les champs sont obligatoires.");
}

// 2. Récupérer les données
$nom = trim($_POST["nom"]);
$noteInfo = $_POST["note_info"];
$noteMath = $_POST["note_math"];

// 3. Vérifier les champs vides
if (
    empty($nom) ||
    $noteInfo === "" ||
    $noteMath === ""
) {
    exit("Erreur : veuillez remplir tous les champs.");
}

// 4. Vérifier que les notes sont numériques
if (!is_numeric($noteInfo) || !is_numeric($noteMath)) {
    exit("Erreur : les notes doivent être numériques.");
}

// 5. Convertir les notes en nombres
$noteInfo = (float) $noteInfo;
$noteMath = (float) $noteMath;

// 6. Vérifier les limites des notes
if (
    $noteInfo < NOTE_MIN ||
    $noteInfo > NOTE_MAX ||
    $noteMath < NOTE_MIN ||
    $noteMath > NOTE_MAX
) {
    exit("Erreur : les notes doivent être comprises entre "
        . NOTE_MIN . " et " . NOTE_MAX . ".");
}

// 7. Protéger le nom pour l'affichage HTML
$nomSecurise = htmlspecialchars(
    $nom,
    ENT_QUOTES,
    "UTF-8"
);

// 8. Calculer la moyenne
$moyenne = ($noteInfo + $noteMath) / 2;

// 9. Afficher le récapitulatif
echo "<h1>Récapitulatif des notes</h1>";

echo "<p>Nom : " . $nomSecurise . "</p>";
echo "<p>Note en informatique : " . $noteInfo . "</p>";
echo "<p>Note en mathématiques : " . $noteMath . "</p>";
echo "<p>Moyenne : " . number_format($moyenne, 2) . "</p>";

?>
<?php
/*
Auteur : Votre nom
Objectif : Valider les notes et les enregistrer dans un fichier CSV
Date : 17/10/2026
*/

const NOTE_MIN = 0;
const NOTE_MAX = 20;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit("Veuillez envoyer le formulaire.");
}

$nom = trim($_POST['nom'] ?? '');
$note_info = $_POST['note_info'] ?? '';
$note_math = $_POST['note_math'] ?? '';

if (
    $nom === '' ||
    $note_info === '' ||
    $note_math === '' ||
    !is_numeric($note_info) ||
    !is_numeric($note_math)
) {
    exit("Erreur : veuillez remplir correctement tous les champs.");
}

$note_info = (float) $note_info;
$note_math = (float) $note_math;

if (
    $note_info < NOTE_MIN || $note_info > NOTE_MAX ||
    $note_math < NOTE_MIN || $note_math > NOTE_MAX
) {
    exit("Erreur : les notes doivent être comprises entre 0 et 20.");
}

$fichier = __DIR__ . '/data/notes.csv';
$handle = fopen($fichier, 'a');

if ($handle === false) {
    exit("Erreur : impossible d'ouvrir le fichier CSV.");
}

fputcsv($handle, [$nom, $note_info, $note_math], ';');
fclose($handle);

$moyenne = ($note_info + $note_math) / 2;

echo "<h2>Enregistrement réussi</h2>";
echo "Nom : " . htmlspecialchars($nom, ENT_QUOTES, 'UTF-8') . "<br>";
echo "Note Info : " . $note_info . "<br>";
echo "Note Math : " . $note_math . "<br>";
echo "Moyenne : " . $moyenne;
?>


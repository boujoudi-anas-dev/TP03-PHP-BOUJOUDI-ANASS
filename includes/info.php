<?php
$nom = htmlspecialchars(trim($_GET["nom"] ?? ""));
$prenom = htmlspecialchars(trim($_GET["prenom"] ?? ""));
$sexe = $_GET["sexe"] ?? "";

if ($nom === "" || $prenom === "") {
    exit("Veuillez saisir le nom et le prénom.");
}

if ($sexe === "M") {
    $civilite = "Monsieur";
} elseif ($sexe === "F") {
    $civilite = "Madame";
} else {
    exit("Veuillez choisir un sexe valide.");
}

echo "Bonjour " . $civilite . " "
    . $prenom . " " . $nom;
?>
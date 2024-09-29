<?php

chdir("../");

require_once('../config.php');
if ($_SESSION['loginType'] != 'admin') {
    header('Location: /');
    exit();
}

$cookAccountPath = '../backend/cookAccount.json';

// Si le fichier JSON n'existe pas, créer un fichier vide avec un tableau vide
if (!file_exists($cookAccountPath)) {
    file_put_contents($cookAccountPath, json_encode([]));
}

// Charger la liste des cuisiniers existants
$cookAccountList = json_decode(file_get_contents($cookAccountPath), true);

// Vérifier si l'ID à supprimer est passé via l'URL
if (isset($_GET['id'])) {
    $idToDelete = trim(htmlspecialchars($_GET['id'])); // Nettoyage de l'input

    // Trouver l'index du cuisinier avec l'ID correspondant
    $cookIndex = -1;
    foreach ($cookAccountList as $index => $cook) {
        if ($cook['id'] === $idToDelete) {
            $cookIndex = $index;
            break;
        }
    }

    // Si le cuisinier est trouvé, le supprimer de la liste
    if ($cookIndex !== -1) {
        array_splice($cookAccountList, $cookIndex, 1); // Supprimer l'entrée spécifique
        file_put_contents($cookAccountPath, json_encode($cookAccountList)); // Sauvegarder la liste mise à jour
        header("Location: /dashboard?ok=Cook with ID '$idToDelete' has been successfully deleted.");
        exit();
    } else {
        header("Location: /dashboard?ko=Cook with ID '$idToDelete' not found.");
    }
} else {
    header("Location: /dashboard?ko=ID not found.");
}

?>

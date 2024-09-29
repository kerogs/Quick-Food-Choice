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

// Vérifier si un identifiant a été soumis
if (isset($_POST['id'])) {
    $id = trim(htmlspecialchars($_POST['id'])); // Nettoyage de l'input
    
    // Créer un tableau pour le nouveau cuisinier
    $newCook = [
        'id' => $id,
        'order' => 0
    ];

    // Vérifier si le cuisinier n'existe pas déjà dans la liste
    $cookExists = false;
    foreach ($cookAccountList as $cook) {
        if ($cook['id'] === $id) {
            $cookExists = true;
            break;
        }
    }

    // Si le cuisinier n'existe pas, l'ajouter à la liste
    if (!$cookExists) {
        $cookAccountList[] = $newCook; // Ajouter le nouveau cuisinier
        file_put_contents($cookAccountPath, json_encode($cookAccountList)); // Sauvegarder la liste mise à jour

        header("Location: /dashboard?ok=The cook has been added.");
        exit();
    } else {
        header("Location: /dashboard?ko=This cook already exists.");
        exit();
    } 
}
?>

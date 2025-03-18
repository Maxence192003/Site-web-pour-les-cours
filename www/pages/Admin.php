<?php
session_start(); // Démarrer la session pour accéder aux variables de session

// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['username'])) {
    $username = htmlspecialchars($_SESSION['username']); // Sécuriser la sortie
    echo "Bonjour, " . $username . " ! Bienvenue sur la page Admin.";
} else {
    echo "Vous devez vous connecter pour accéder à cette page.";
    echo '<br><a href="connexion.php">Se connecter</a>';
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
</head>
<body>
<br>
<a href="./ajouter.php">Ajouter</a>
<a href="./lire.php">Modifier</a>
<br>
<a href="../index.php">Index</a>

</body>
</html>
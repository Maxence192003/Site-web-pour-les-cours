<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
</head>
<body>

<p>Vous êtes sur la page d'accueil</p>
<a href="./pages/connexion.php">Connexion</a>
<a href="./pages/inscription.php">Inscription</a>
<br>
</body>
</html>
<?php
// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['username'])) {
    $username = htmlspecialchars($_SESSION['username']); // Sécuriser la sortie
    echo "Bonjour, " . $username . " ! Bienvenue sur la page Index.";
} else {
    echo "Vous devez vous connecter pour accéder à cette page.";
    echo '<br><a href="./pages/connexion.php">Se connecter</a>';
}
?>
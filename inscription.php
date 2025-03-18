<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>
<body>

    <form method="POST" action="traitement.php">
        <label for="username">Votre nom</label>
        <input type="text" id="username" name="username" placeholder="Entrer votre nom" required>
        <br>
        <label for="email">Votre Mail</label>
        <input type="email" id="email" name="email" placeholder="Entrer votre adresse mail" required>
        <br>
        <label for="password">Votre Mot de Passe</label>
        <input type="password" id="password" name="password" placeholder="Entrer votre mot de passe" required>
        <br>
        <button type="submit" name="ok">M'inscrire</button>
        <button onclick="window.location.href='../index.php'">Annuler</button>
    </form>

</body>
</html>
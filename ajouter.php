<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter</title>
</head>
<body>

    <form method="POST" action="traitement_biblio.php">
        <label for="Titre">Votre Titre</label>
        <input type="text" id="Titre" name="Titre" placeholder="Entrer votre titre" required>
        <br>
        <label for="Auteur">Votre Auteur</label>
        <input type="text" id="Auteur" name="Auteur" placeholder="Entrer votre auteur" required>
        <br>
        <label for="Bio">Biographie de l'auteur</label>
        <input type="text" id="Bio" name="Bio" placeholder="Entrer la biographie" required>
        <br>
        <label for="Desc">Description de l'oeuvre</label>
        <input type="text" id="Desc" name="Desc" placeholder="Entrer la déscription" required>
        <br>
        <button type="submit" name="okay">Ajouter</button>
        <button onclick="window.location.href='./Admin.php'">Annuler</button>
    </form>

</body>
</html>
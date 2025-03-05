<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer</title>
</head>
<body>
    <!--Rajouter un systeme qui donne acces aux donné de la basses pour pouvoir mieux supprimer-->
    <form method="POST" action="traitement_biblio.php">
        <label for="Auteur">Titre</label>
        <input type="text" name="Titre" placeholder="Entrez le titre à supprimer" required>
        <br>
        <label for="Auteur">Auteur</label>
        <input type="text" name="Auteur" placeholder="Entrez l'auteur à supprimer" required>
        <br>
        <br>
        <button type="submit" name="note_ok">Supprimer</button>
        <button onclick="window.location.href='./Admin.php'">Annuler</button>
    </form>
</body>
</html>

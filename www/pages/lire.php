<?php
// Connexion à la base de données
$servername = "mysql"; // Essaie "localhost" si "mysql" ne fonctionne pas
$username = "root";
$password = "root";
$dbname = "test_db";

try {
    // Connexion à la base de données
    $bdd = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8mb4", $username, $password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Récupérer les données de la table `biblio`
try {
    $sql = "SELECT * FROM biblio";
    $stmt = $bdd->query($sql);
    $livres = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur SQL : " . $e->getMessage());
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Livres</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h2>Liste des Livres</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Titre</th>
            <th>Auteur</th>
            <th>Bio</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
        <?php if (count($livres) > 0): ?>
            <?php foreach ($livres as $livre): ?>
                <tr>
                    <td><?= htmlspecialchars($livre['id_titre']) ?></td>
                    <td><?= htmlspecialchars($livre['Titre']) ?></td>
                    <td><?= htmlspecialchars($livre['Auteur']) ?></td>
                    <td><?= htmlspecialchars($livre['Bio']) ?></td>
                    <td><?= htmlspecialchars($livre['Desc']) ?></td>
                    <td>
                        <a href="modifier.php?id=<?= $livre['id_titre'] ?>">Modifier</a> |
                        <a href="suprime.php?id=<?= $livre['id_titre'] ?>" onclick="return confirm('Voulez-vous vraiment supprimer ce livre ?')">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan='6'>Aucun livre trouvé.</td></tr>
        <?php endif; ?>
    </table>
    <br>
    <a href="ajouter.php">Ajouter un Livre</a>
</body>
</html
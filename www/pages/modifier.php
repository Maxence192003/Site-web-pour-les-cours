<?php
// Connexion à la base de données
$servername = "mysql"; // Essaie "localhost" si "mysql" ne fonctionne pas
$username = "root";
$password = "root";
$dbname = "test_db";

try {
    $bdd = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8mb4", $username, $password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Vérifier si un ID est passé dans l'URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID invalide.");
}

$id = $_GET['id'];

// Récupérer les informations du livre à modifier
$sql = "SELECT * FROM biblio WHERE id_titre = :id";
$stmt = $bdd->prepare($sql);
$stmt->execute(['id' => $id]);
$livre = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$livre) {
    die("Livre non trouvé.");
}

// Traitement de la mise à jour
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titre = trim($_POST['titre']);
    $auteur = trim($_POST['auteur']);
    $bio = trim($_POST['bio']);
    $desc = trim($_POST['desc']);

    // Vérifier si un livre avec le même titre et auteur existe déjà (sauf celui en cours de modification)
    $sqlCheck = "SELECT COUNT(*) FROM biblio WHERE Titre = :titre AND Auteur = :auteur AND id_titre != :id";
    $stmtCheck = $bdd->prepare($sqlCheck);
    $stmtCheck->execute(['titre' => $titre, 'auteur' => $auteur, 'id' => $id]);
    $count = $stmtCheck->fetchColumn();

    if ($count > 0) {
        echo "<p style='color:red;'>Erreur : Un livre avec ce titre et cet auteur existe déjà.</p>";
    } else {
        // Mettre à jour les informations du livre
        $sql = "UPDATE biblio SET Titre = :titre, Auteur = :auteur, Bio = :bio, `Desc` = :desc WHERE id_titre = :id";
        $stmt = $bdd->prepare($sql);

        if ($stmt->execute(['titre' => $titre, 'auteur' => $auteur, 'bio' => $bio, 'desc' => $desc, 'id' => $id])) {
            echo "<p style='color:green;'>Livre mis à jour avec succès.</p>";
            echo "<br><a href='lire.php'>Retour à la liste</a>";
            exit;
        } else {
            echo "<p style='color:red;'>Erreur lors de la mise à jour.</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Livre</title>
</head>
<body>
    <h2>Modifier le Livre</h2>
    <form method="post">
        <label>Titre :</label>
        <input type="text" name="titre" value="<?= htmlspecialchars($livre['Titre']) ?>" required><br>

        <label>Auteur :</label>
        <input type="text" name="auteur" value="<?= htmlspecialchars($livre['Auteur']) ?>" required><br>

        <label>Biographie :</label>
        <textarea name="bio" required><?= htmlspecialchars($livre['Bio']) ?></textarea><br>

        <label>Description :</label>
        <textarea name="desc" required><?= htmlspecialchars($livre['Desc']) ?></textarea><br>

        <input type="submit" value="Mettre à jour">
    </form>
    <br>
    <a href="lire.php">Annuler</a>
</body>
</html>

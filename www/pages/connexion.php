<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "mysql";
$username = "root";
$password = "root";
$erreur = "";

try {
    // Connexion à la base de données
    $bdd = new PDO("mysql:host=$servername;dbname=test_db", $username, $password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} 
catch (PDOException $e) {
    // En cas d'erreur de connexion
    die("Erreur : " . $e->getMessage()); // Utiliser die() au lieu de echo pour éviter d'envoyer des headers
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];
    
    if (!empty($email) && !empty($password)) {
        // Requête pour récupérer le hachage du mot de passe et le nom d'utilisateur
        $req = $bdd->prepare("SELECT username, password FROM users WHERE email = :email");
        $req->execute(['email' => $email]);
        $user = $req->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $hashed_password = $user['password'];

            if (password_verify($password, $hashed_password)) {
                $_SESSION['username'] = $user['username'];
                header("Location: Admin.php");
                exit();
            }
        }

        $erreur = "Email ou mot de passe incorrect !";
    } else {
        $erreur = "Veuillez remplir tous les champs.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body>

    <form method="POST" action="">
        <label for="email">Email :</label>
        <input type="email" name="email" id="email" required>
        <br>
        <label for="password">Mot de passe :</label>
        <input type="password" name="password" id="password" required>
        <br>
        <button type="submit">Se connecter</button>
        <button onclick="window.location.href='../index.php'">Annuler</button>
    </form>

    <?php if (!empty($erreur)) { echo "<p style='color:red;'>$erreur</p>"; } ?>

</body>
</html>
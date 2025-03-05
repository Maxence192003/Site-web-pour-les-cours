<?php

$servername = "mysql";
$username = "root";
$password = "root";
//Notes :
// Mettre en place un blocage sur les nom d'utilisateur pour eviter ex Achete du viagras https://http://localhost:8080/ww...
try {
    // Connexion à la base de données
    $bdd = new PDO("mysql:host=$servername;dbname=test_db", $username, $password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // En cas d'erreur de connexion
    echo "Erreur : " . $e->getMessage();
    die(); // Terminer le script si la connexion échoue
}


// Vérifier si le formulaire a été soumis
if (isset($_POST['ok'])) {
    // Vérification des données envoyées par le formulaire
    if (!empty($_POST["username"]) && !empty($_POST["email"]) && !empty($_POST["password"])) {
        $username = htmlspecialchars($_POST["username"]);
        $email = htmlspecialchars($_POST["email"]);
        $password = $_POST["password"];

        // Hachage du mot de passe
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Préparer la requête SQL
        try {
            $requete = $bdd->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
            $requete->execute([
                'username' => $username,
                'email' => $email,
                'password' => $hashed_password
            ]);

            header("Location: connexion.php");
            exit();
        } catch (PDOException $e) {
            echo "Erreur lors de l'inscription : " . $e->getMessage();
        }
    } else {
        echo "Tous les champs sont obligatoires.";
    }
} else {
    echo "Formulaire non soumis.";
}

?>

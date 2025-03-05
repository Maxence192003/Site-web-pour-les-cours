<?php
//notes:
// Faire un systeme qui bloque quand le titre et l'auteur à ajouter est le même que celui en ligne de la bases de donnés est égal 0
$servername = "mysql";
$username = "root";
$password = "root";

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
if (isset($_POST['okay'])) {  // ✅ Correction de $_Poste en $_POST
    $Titre = $_POST['Titre'];
    $Auteur = $_POST['Auteur'];
    $Bio = $_POST['Bio'];
    $Desc = $_POST['Desc'];

    // Préparation et exécution de la requête sécurisée
    $requete = $bdd->prepare("INSERT INTO biblio (Titre, Auteur, Bio, `Desc`) VALUES (?,?,?,?)");
    $requete->execute(array($Titre,$Auteur,$Bio,$Desc
    ));

    echo "Inscription validée"; // ✅ Ajout du point-virgule
}
if (isset($_POST['note_okay'])) {
    $Titre = $_POST['Titre'];
    $Auteur = $_POST['Auteur'];
    $requete = $bdd->prepare("DELETE FROM biblio WHERE Titre = ? and Auteur = ?");
    $requete->execute([$Titre,$Auteur]);

    echo "Suppression réussie !";
}
?>

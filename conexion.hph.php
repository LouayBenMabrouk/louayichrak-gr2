<?php
// Connexion à la base de données
$servername = "localhost";
$username = "votre_nom_utilisateur";
$password = "votre_mot_de_passe";
$dbname = "votre_base_de_données";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Paramétrage de la connexion PDO pour lever des exceptions en cas d'erreur
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}

// Vérification de la soumission du formulaire de connexion
if(isset($_POST['submit'])) {
    // Récupération des données saisies dans le formulaire
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Requête préparée pour récupérer l'utilisateur correspondant à l'email fourni
    $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Vérification du mot de passe si l'utilisateur est trouvé
    if($user) {
        if(password_verify($password, $user['mot_de_passe'])) {
            // Authentification réussie, rediriger vers une page sécurisée
            header("Location: page_securisee.php");
            exit();
        } else {
            // Mot de passe incorrect
            $errorMessage = "Mot de passe incorrect";
        }
    } else {
        // Utilisateur non trouvé
        $errorMessage = "Adresse email incorrecte";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Page de Connexion</title>
</head>
<body>
    <h2>Connexion</h2>
    <?php if(isset($errorMessage)) { ?>
        <div><?php echo $errorMessage; ?></div>
    <?php } ?>
    <form method="post">
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div>
            <label for="password">Mot de passe:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div>
            <input type="submit" name="submit" value="Se connecter">
        </div>
    </form>
</body>
</html>
<?php
// Inclusion des fichiers de connexion et de la définition de la classe User
include_once("connexion.php");
include_once("user.php");

// Création de l'objet PDO à partir de la connexion
$pdo = new PDOConnection();

// Création de l'objet User à partir de la connexion PDO
$user = new User($pdo);

// Fonction pour créer un nouvel utilisateur
function createUser($pdo, $name, $email, $password) {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT INTO utilisateurs (name, email, password) VALUES (:name, :email, :password)");
    $stmt->execute([':name' => $name, ':email' => $email, ':password' => $hashedPassword]);
}

// Fonction pour récupérer un utilisateur par son email
function getUserByEmail($pdo, $email) {
    $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE email = :email");
    $stmt->execute([':email' => $email]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Fonction pour mettre à jour le mot de passe d'un utilisateur
function updatePassword($pdo, $email, $newPassword) {
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("UPDATE utilisateurs SET password = :password WHERE email = :email");
    $stmt->execute([':password' => $hashedPassword, ':email' => $email]);
}

// Fonction pour supprimer un utilisateur
function deleteUser($pdo, $email) {
    $stmt = $pdo->prepare("DELETE FROM utilisateurs WHERE email = :email");
    $stmt->execute([':email' => $email]);
}

// Exemple d'utilisation :
// Créer un nouvel utilisateur
createUser($pdo, "John Doe", "john@example.com", "password123");

// Récupérer un utilisateur par son email
$userData = getUserByEmail($pdo, "john@example.com");
print_r($userData);

// Mettre à jour le mot de passe de l'utilisateur
updatePassword($pdo, "john@example.com", "newpassword");

// Supprimer l'utilisateur
deleteUser($pdo, "john@example.com");
?>
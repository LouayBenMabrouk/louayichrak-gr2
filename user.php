<?php
class User {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    // Méthode pour créer un nouvel utilisateur
    public function create($name, $email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare("INSERT INTO utilisateurs (name, email, password) VALUES (:name, :email, :password)");
        $stmt->execute([':name' => $name, ':email' => $email, ':password' => $hashedPassword]);
        return $this->pdo->lastInsertId();
    }

    // Méthode pour récupérer un utilisateur par son email
    public function getByEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM utilisateurs WHERE email = :email");
        $stmt->execute([':email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Méthode pour mettre à jour le mot de passe d'un utilisateur
    public function updatePassword($email, $newPassword) {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare("UPDATE utilisateurs SET password = :password WHERE email = :email");
        $stmt->execute([':password' => $hashedPassword, ':email' => $email]);
    }

    // Méthode pour supprimer un utilisateur
    public function delete($email) {
        $stmt = $this->pdo->prepare("DELETE FROM utilisateurs WHERE email = :email");
        $stmt->execute([':email' => $email]);
    }

    // Méthode pour vérifier si un email existe déjà dans la base de données
    public function emailExists($email) {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM utilisateurs WHERE email = :email");
        $stmt->execute([':email' => $email]);
        return $stmt->fetchColumn() > 0;
    }

    // Méthode pour valider le mot de passe d'un utilisateur
    public function validatePassword($email, $password) {
        $stmt = $this->pdo->prepare("SELECT password FROM utilisateurs WHERE email = :email");
        $stmt->execute([':email' => $email]);
        $hashedPassword = $stmt->fetchColumn();
        return password_verify($password, $hashedPassword);
    }
}

// Exemple d'utilisation :
// Créer une instance de la classe User en passant l'objet PDO en paramètre
$user = new User($pdo);

// Créer un nouvel utilisateur
$user->create("John Doe", "john@example.com", "password123");

// Récupérer un utilisateur par son email
$john = $user->getByEmail("john@example.com");

// Mettre à jour le mot de passe de l'utilisateur John
$user->updatePassword("john@example.com", "newpassword");

// Supprimer l'utilisateur John
$user->delete("john@example.com");
?>
<?php

require_once "config.php";


class User {
    private $pdo;
    private $id;
    private $name;
    private $email;
    private $password;
    private $role;



    public function __construct() {
        $database = new Database();
        $this->pdo = $database->getConnection();
    }

    public function getAllUsers() {
        $sql = "SELECT * FROM users WHERE role = 'member' ";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function signinCheck($email, $password) {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':email' => $email
        ]);
    
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($user) {
            echo "Fetched user: " . print_r($user, true);
            if (password_verify($password, $user['password'])) {
                echo "Password verified.";
                return true;
            } else {
                echo "Password verification failed.";
            }
        } else {
            echo "No user found for email: $email.";
        }
        return false;
    }

    public function getUserByEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
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
        $stmt->execute([':email' => $email]);
    
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($user) {
            if (password_verify($password, $user['password'])) {
                return true;
            }
        }
        return false;
    }

    public function getUserByEmail($email) {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    

    public function SignUp($name, $email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $sql = "INSERT INTO users (name,email,password,role) values (:name,:email,:password, 'member')";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            "name"=> htmlspecialchars($name),
            "email"=> htmlspecialchars($email),
            "password"=> $hashedPassword
        ]);
    }

}
?>
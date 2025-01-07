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
        $sql = "SELECT u.* FROM users u join user_role ur on u.id = ur.user_id WHERE ur.role_id = 3";
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
        try {

            $sql = "SELECT * FROM users WHERE email = :email";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':email' => $email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if (!$user) {
                return null;
            }

            $sql = "SELECT * FROM user_role WHERE user_id = :user_id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':user_id' => $user['id']]);
            $roles = $stmt->fetch(PDO::FETCH_ASSOC);
            return $roles;
        } catch (PDOException $e) {
            error_log("Error fetching user or roles: " . $e->getMessage());
            return null;
        }
    }
    
    

    public function SignUp($name, $email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $sql = "INSERT INTO users (name,email,password) values (:name,:email,:password)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            "name"=> htmlspecialchars($name),
            "email"=> htmlspecialchars($email),
            "password"=> $hashedPassword
        ]);

        $lastId = $this->pdo->lastInsertId();

        $sql = "INSERT INTO user_role (user_id , role_id ) values (:user_id , :role_id )";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'user_id'=>$lastId,
            'role_id'=>3
        ]);
    }
    
}
?>
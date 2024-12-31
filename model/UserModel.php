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
}
?>
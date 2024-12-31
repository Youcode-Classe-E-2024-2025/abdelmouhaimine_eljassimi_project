<?php

require_once "config.php";


class Project {
    private $pdo;
    private $name;
    private $description;



    public function __construct() {
        $database = new Database();
        $this->pdo = $database->getConnection();
    }

    public function create($name, $description) {
        $sql = "INSERT INTO projects (name, description) VALUES (:name, :description)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':name' => $name,
            ':description' => $description,
        ]);
    }

    public function getAll() {
        $sql = "SELECT * FROM projects";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>
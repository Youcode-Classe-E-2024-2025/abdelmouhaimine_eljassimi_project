<?php

require_once "config.php";


class Project {
    private $pdo;
    private $name;
    private $description;
    private $deadline;



    public function __construct() {
        $database = new Database();
        $this->pdo = $database->getConnection();
    }

    public function create($name, $description, $deadline) {
        $sql = "INSERT INTO projects (name, description, deadline) VALUES (:name, :description, :deadline)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':name' => $name,
            ':description' => $description,
            ':deadline' => $deadline
        ]);
    }

    public function getAll() {
        $sql = "SELECT * FROM projects";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>
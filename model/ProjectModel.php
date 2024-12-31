<?php

require_once "config.php";


class Project {
    private $pdo;
    private $id;
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
    public function update($name, $description, $id) {
        $sql = "UPDATE projects SET name = :name, description = :description WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':name' => $name,
            ':description' => $description,
            ':id' => $id
        ]);
    }
    public function delete($id) {
        $sql = "DELETE FROM projects WHERE id=$id";
        $stmt = $this->pdo->query($sql);
        $stmt->execute();
    }
}

?>
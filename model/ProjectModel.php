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

    public function create($name, $description,$user_id) {
        $sql = "INSERT INTO projects (name, description) VALUES (:name, :description)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':name' => htmlspecialchars($name) ,
            ':description' => htmlspecialchars($description),
        ]);
        
        $projectId = $this->pdo->lastInsertId();
        $stmt = $this->pdo->prepare("INSERT INTO project_members (project_id, user_id) VALUES (:project_id, :user_id)");
            foreach ($user_id as $userId) {
                $stmt->execute([
                    ':project_id' =>  $projectId,
                    ':user_id' => $userId,
                ]);
            }
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
            ':name' => htmlspecialchars($name) ,
            ':description' => htmlspecialchars($description),
            ':id' => htmlspecialchars($id)
        ]);
    }
    public function delete($id) {
        $sql = "DELETE FROM projects WHERE id=$id";
        $stmt = $this->pdo->query($sql);
        $stmt->execute();
    }
}
?>
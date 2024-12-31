<?php

require_once "config.php";
class Task {
    private $pdo;
    private $name;
    private $description;
    private $assignedTo;



    public function __construct($name,$status,$assignedTo) {
        $this->name = $name;
        $this->description = $status;
        $this->deadline = $assignedTo;
        $database = new Database();                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 
        $this->pdo = $database->getConnection();
    }

    // Save task to the database
    public function create($projectId, $name, $status, $assignedTo) {
        $sql = "INSERT INTO tasks (project_id, name, status, assigned_to) VALUES (:project_id, :name, :status, :assigned_to)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':project_id' => $projectId,
            ':name' => $name,
            ':status' => $status,
            ':assigned_to' => $assignedTo
        ]);
    }

    // Get tasks by project ID
    public function getByProjectId($projectId) {
        $sql = "SELECT * FROM tasks WHERE project_id = :project_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':project_id' => $projectId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

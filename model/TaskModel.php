<?php

require_once "config.php";
class Task {
    private $pdo;
    private $title;
    private $description;
    private $status;
    private $due_date;



    public function __construct() {
        $database = new Database();                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 
        $this->pdo = $database->getConnection();
    }

    // Save task to the database
    public function create($projectId, $title,$description,$category_id, $status, $duedate) {
        $sql = "INSERT INTO tasks (project_id, title, status, description,category_id,duedate) VALUES (:project_id, :title, :status, :description,:category_id,:duedate)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':project_id' => $projectId,
            ':name' => $title,
            'status'=> $status,
            'description'=> $description,
            'category_id'=> $category_id,
            'duedate'=> $duedate
        ]);
    }

    public function getByProjectId($projectId) {
        $sql = "SELECT * FROM tasks WHERE project_id = :project_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':project_id' => $projectId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

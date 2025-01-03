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
    public function create($projectId, $title,$description,$category_id, $status, $duedate,$user_id,$tag) {
        $sql = "INSERT INTO tasks (project_id, title, status, description,category_id,due_date) VALUES (:project_id, :title, :status, :description,:category_id,:due_date)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':project_id' => $projectId,
            ':title' => $title,
            'status'=> $status,
            'description'=> $description,
            'category_id'=> $category_id,
            'due_date'=> $duedate
        ]);
        $taskId = $this->pdo->lastInsertId();
        $stmt = $this->pdo->prepare("INSERT INTO task_assignments (task_id, user_id) VALUES (:task_id, :user_id)");
            foreach ($user_id as $userId) {
                $stmt->execute([
                    ':task_id' =>  $taskId,
                    ':user_id' => $userId,
                ]);
            }
        $stmt = $this->pdo->prepare("INSERT INTO task_tags (task_id, tag_id) VALUES (:task_id, :tag_id)");
            foreach ($user_id as $userId) {
                $stmt->execute([
                    ':task_id' =>  $taskId,
                    ':tag_id' => $tag,
                ]);
            }
    }

    public function getByProjectId($projectId) {
        $sql = "SELECT * FROM tasks WHERE project_id = :project_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':project_id' => $projectId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function delete($id){
        $sql = 'DELETE FROM tasks WHERE id=:id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':id' => $id
        ]);
    }
    public function edit($idtask, $title, $description, $status) {
        $sql = 'UPDATE tasks SET title = :title, description = :description, status = :status WHERE id = :idtask';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':idtask' => $idtask, 
            ':title' => $title,
            ':status' => $status,
            ':description' => $description
        ]);
    }

    public function getProjectMembers($projectId){
        $sql = 'SELECT u.name FROM users u join project_members pm on u.id = pm.user_id WHERE pm.project_id = :projectId;';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['projectId'=> $projectId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}

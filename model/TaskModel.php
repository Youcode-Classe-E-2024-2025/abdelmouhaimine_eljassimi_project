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
            ':title' => htmlspecialchars($title),
            'status'=> htmlspecialchars($status),
            'description'=> htmlspecialchars($description),
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

            $stmt = $this->pdo->prepare("INSERT INTO activities (project_id, task_id, user_id, action,details)VALUES (:project_id, :task_id, :user_id, 'create task','Created a new task');");
            $stmt->execute([
                ':project_id' =>  $projectId,
                ':task_id'=> $taskId,
                ':user_id' => $_SESSION["user_id"],
            ]);
    }

    public function getByProjectId($projectId) {
        $sql = "SELECT * FROM tasks WHERE project_id = :project_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':project_id' => $projectId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function delete($id,$idProject){

        $stmt = $this->pdo->prepare("INSERT INTO activities (project_id, task_id, user_id, action,details)VALUES (:project_id, :task_id, :user_id, 'delete task','Delete task');");
        $stmt->execute([
            ':project_id'=>$idProject,
            ':task_id' =>  $id,
            ':user_id' => $_SESSION["user_id"],
        ]);

        $sql = 'DELETE FROM tasks WHERE id=:id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':id' => $id
        ]);
    }
    public function edit($idProject,$idtask, $title, $description, $status) {
        $sql = 'UPDATE tasks SET title = :title, description = :description, status = :status WHERE id = :idtask';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':idtask' => $idtask, 
            ':title' => htmlspecialchars($title),
            ':status' => htmlspecialchars($status),
            ':description' => htmlspecialchars($description)
        ]);
        $stmt = $this->pdo->prepare("INSERT INTO activities (project_id, task_id, user_id, action,details) VALUES (:project_id, :task_id, :user_id, 'edit task','Update task');");
        $stmt->execute([
            ':task_id'=> $idtask,
            ':project_id'=> $idProject,
            ':user_id' => $_SESSION["user_id"],
        ]);
    }

    public function getProjectMembers($projectId){
        $sql = 'SELECT * FROM users u join project_members pm on u.id = pm.user_id WHERE pm.project_id = :projectId;';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['projectId'=> $projectId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function editRolePermission($user_id, $project_id, $role) {
        $sql = "UPDATE user_project_roles  SET role_id = :role_id WHERE user_id = :user_id AND project_id = :project_id;";
        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':role_id' => htmlspecialchars($role),
            ':user_id' => htmlspecialchars($user_id),
            ':project_id' => htmlspecialchars($project_id)
        ]);

        $sql = "UPDATE user_role SET role_id = :role_id WHERE user_id = :user_id";
        $stmt = $this->pdo->prepare($sql);

            $stmt->execute([
                ':user_id' => htmlspecialchars($user_id),
                ':role_id' => htmlspecialchars($role)
            ]);
    }

    public function getTimeline($id){
        $sql = "SELECT u.name AS user, a.action, a.timestamp  FROM activities a JOIN users u ON a.user_id = u.id WHERE a.project_id = :project_id ORDER BY a.timestamp DESC";     
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(["project_id"=>$id]);
        return $stmt->fetchAll(PDO:: FETCH_ASSOC);
    }
}

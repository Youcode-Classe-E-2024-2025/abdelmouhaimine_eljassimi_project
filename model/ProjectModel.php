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

    public function create($name, $description,$user_id,$accesiblity) {
        $sql = "INSERT INTO projects (name, description,is_public) VALUES (:name, :description,:is_public)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':name' => htmlspecialchars($name) ,
            ':description' => htmlspecialchars($description),
            'is_public'=> $accesiblity
        ]);
        
        $projectId = $this->pdo->lastInsertId();
        $stmt = $this->pdo->prepare("INSERT INTO project_members (project_id, user_id) VALUES (:project_id, :user_id)");
            foreach ($user_id as $userId) {
                $stmt->execute([
                    ':project_id' =>  $projectId,
                    ':user_id' => $userId,
                ]);
            }
        
        $stmt = $this->pdo->prepare("INSERT INTO user_project_roles (project_id, user_id, role_id) VALUES (:project_id, :user_id,:role_id)");
            foreach ($user_id as $userId) {
                $stmt->execute([
                    ':project_id' =>  $projectId,
                    ':user_id' => $userId,
                    ':role_id' => 3
                ]);
            }

        $stmt = $this->pdo->prepare("INSERT INTO user_project_roles (project_id, user_id, role_id) VALUES (:project_id, :user_id,:role_id)");
                $stmt->execute([
                    ':project_id' =>  $projectId,
                    ':user_id' => $_SESSION["user_id"],
                    ':role_id' => 2
                ]);
    }

    public function getAll($userId, $roleId) {
        try {
            if($roleId != 1){
                $sql = "SELECT p.* FROM projects p  JOIN user_project_roles upr ON p.id = upr.project_id WHERE upr.user_id = :user_id AND upr.role_id = :role";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([':user_id' => $userId, ':role' => $roleId]);
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }else {
                $sql = "SELECT * FROM projects";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        } catch (PDOException $e) {
            error_log("Error fetching projects: " . $e->getMessage());
            return [];
        }
    }
    

    public function getVisitorAll() { 
        $sql = " SELECT * FROM projects WHERE is_public = 0";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
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
        $sql = "DELETE FROM projects WHERE id= :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':id' => htmlspecialchars($id)
        ]);
    }

    public function deletemember($idUser,$idProject){
        $sql = "DELETE FROM project_members WHERE project_id = :project_id AND user_id = :user_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':project_id' => htmlspecialchars($idProject),
            ':user_id' => htmlspecialchars($idUser)
        ]);
    }

    public function GetDescription($id){
        $sql =" SELECT * FROM projects WHERE id = :id ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(["id"=>$id]);
        return $stmt->fetch(PDO:: FETCH_ASSOC);
    }
    public function GenerateSheet($id) {
        $sql = "SELECT  p.name AS project_name,  t.title AS task_name, t.status,   t.created_at FROM projects p JOIN tasks t ON t.project_id = p.id WHERE p.id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
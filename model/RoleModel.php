<?php
require_once "config.php";

class Role{
    
    private $pdo;
    private $id ; 
    private $name;

    public function __construct() {
        $database = new Database();
        $this->pdo = $database->getConnection();
    }

    public function role(){
      $sql = " SELECT * FROM roles";
      $stmt = $this->pdo->prepare($sql);
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getRole($user_id, $project_id) {
        try {
            $query = "  SELECT role_id from user_project_roles where user_id = :user_id and project_id = :project_id";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->bindParam(':project_id', $project_id, PDO::PARAM_INT);
            $stmt->execute();

            $role = $stmt->fetch(PDO::FETCH_ASSOC);
            return $role ? $role['role_id'] : null;

        } catch (PDOException $e) {
            error_log("Error fetching role: " . $e->getMessage());
            return null;
        }
    }

    public function EditePermissions($roleId,$permissions){
        try {
            $query = "DELETE FROM role_permissions WHERE role_id = :role_id;";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':role_id', $roleId, PDO::PARAM_INT);
            $stmt->execute();

            $query = "INSERT INTO role_permissions (role_id,permission_id) values (:role_id, :permission_id);";
            $stmt = $this->pdo->prepare($query);

            foreach ($permissions as $permission) {
                $stmt->execute([
                    'role_id'=>$roleId,
                    'permission_id'=>$permission
                ]);
            }
        } catch (PDOException $e) {
            error_log("Error fetching role: " . $e->getMessage());
            return null;
        }
    }

    public function createrole($rolename,$permissions){
        try {
            $sql = "INSERT INTO roles (name) values (:name);";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['name'=>$rolename]);

            $roleId = $this->pdo->lastInsertId();

            $query = "INSERT INTO role_permissions (role_id,permission_id) values (:role_id, :permission_id);";
            $stmt = $this->pdo->prepare($query);

            foreach ($permissions as $permission) {
                $stmt->execute([
                    'role_id'=>$roleId,
                    'permission_id'=>$permission
                ]);
            }
        } catch (PDOException $e) {
            error_log("Error fetching role: " . $e->getMessage());
            return null;
        }
    }
    
    
    


    
}

?>
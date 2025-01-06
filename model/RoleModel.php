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
    
    
    


    
}

?>
<?php
require_once "config.php";

class Permissions{
    
    private $pdo;
    private $id ; 
    private $name;

    public function __construct() {
        $database = new Database();
        $this->pdo = $database->getConnection();
    }

    public function getPermissions($id_role) {
        try {
            $query = "SELECT p.id, p.name FROM permissions p JOIN role_permissions rp ON p.id = rp.permission_id WHERE rp.role_id = :id_role";
    
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':id_role', $id_role, PDO::PARAM_INT);
            $stmt->execute();
    
            $permissions = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            return $permissions;
        } catch (PDOException $e) {
            error_log("Error fetching permissions: " . $e->getMessage());
            return [];
        }
    }

    public function getAllPermissions(){
        $sql = "SELECT * FROM permissions";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

    

    
}

?>
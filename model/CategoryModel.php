<?php
require_once "config.php";

class Category{
    private $pdo;

    public function __construct() {
        $database = new Database();                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 
        $this->pdo = $database->getConnection();
    }

    public function getCategory() {
        $sql = "SELECT * FROM categories ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>
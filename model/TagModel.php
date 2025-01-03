<?php
require_once "config.php";

class Tag{
    private $pdo;

    public function __construct() {
        $database = new Database();                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 
        $this->pdo = $database->getConnection();
    }

    public function getTag() {
        $sql = "SELECT * FROM tags ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getTaskTag($task_id){
        $sql = 'SELECT t.name, t.color FROM tags t JOIN task_tags tt ON t.id = tt.tag_id WHERE tt.task_id = :task_id;';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':task_id' => $task_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

?>
<?php

require_once "model/TaskModel.php";


class TaskController {
    private $taskModel;

    public function __construct() {
        $this->taskModel = new Task(); 
    }

    public function createProject($projectId, $title,$description,$category_id, $status, $duedate) {
        $this->taskModel->create($projectId, $title,$description,$category_id, $status, $duedate);
        header("location: index.php?action=kanban.php?id=$projectId");
    }

    public function showProjects($projectId) {
        $tasks = $this->taskModel->getByProjectId($projectId);
        require "view/kanban.php";
    }

    // public function editProject($name,$description,$id) {
    //     $this->taskModel->update($name, $description, $id);
    //     header("location: index.php");
    // }

    // public function deleteProject($id) {
    //     $this->taskModel->delete($id);
    //     header("location: index.php");
    // }
}

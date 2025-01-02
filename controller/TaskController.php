<?php

require_once "model/TaskModel.php";
require_once "model/UserModel.php";
require_once "model/CategoryModel.php";

class TaskController {
    private $taskModel;

    public function __construct() {
        $this->taskModel = new Task();

    }

    public function createTask($projectId, $title,$description,$category_id, $status, $duedate,$user_id) {
        $this->taskModel->create($projectId, $title,$description,$category_id, $status, $duedate,$user_id);
        header("location: index.php?action=kanban&id=$projectId");
    }

    public function showProjects($projectId) {
        $tasks = $this->taskModel->getByProjectId($projectId);
        require "view/kanban.php";
    }
    public function afficheTaksForm(){
        $UserModel = new User();
        $users = $UserModel->getAllUsers();
        $CategoryModel = new Category();
        $Categorys = $CategoryModel->getCategory();
        require 'view/task_create_form.php';
    }

    // public function editProject($name,$description,$id) {
    //     $this->taskModel->update($name, $description, $id);
    //     header("location: index.php");
    // }

    public function deleteTask($idTask,$idProject) {
        $this->taskModel->delete($idTask);
        header("location: index.php?action=kanban&id=". $idProject);
    }
    public function EditTask($idProject,$idTask,$name, $description,$status){
        $this->taskModel->edit($idTask,$name,$description,$status);
        header("location: index.php?action=kanban&id=". $idProject);
    }
}

<?php

require_once "model/TaskModel.php";
require_once "model/UserModel.php";
require_once "model/CategoryModel.php";
require_once "model/TagModel.php";
require_once "model/RoleModel.php";
require_once "model/PermissionsModel.php";
session_start();
class TaskController {
    private $taskModel;
    private $tagModel;
    private $RoleModel;
    private $PermissionModel;

    public function __construct() {
        $this->taskModel = new Task();
        $this->tagModel = new Tag();
        $this->RoleModel = new Role();
        $this->PermissionModel = new Permissions();

    }

    public function createTask($projectId, $title,$description,$category_id, $status, $duedate,$user_id,$tag) {
        $this->taskModel->create($projectId, $title,$description,$category_id, $status, $duedate,$user_id,$tag);
        header("location: index.php?action=kanban&id=$projectId");
    }

    public function showProjects($projectId) {
        $tasks = $this->taskModel->getByProjectId($projectId);
        $members = $this->taskModel->getProjectMembers($projectId);
        
        if (!isset($_SESSION['user_id'])) {
            die("User not logged in.");
        }
        
    
        $role_id = $this->RoleModel->getRole($_SESSION['user_id'], $projectId);
        if (!$role_id) {
            die("No role found for user in project $projectId");
        }
        $permissions = $this->PermissionModel->getPermissions($role_id);
        if (!$permissions) {
            die("No permissions found for role $role_id");
        }
        require "view/kanban.php";
    }
    
    
    public function ChartTasks($projectId){
        $tasks = $this->taskModel->getByProjectId($projectId);
        require "view/dashboard.php";
    }
    public function afficheTaksForm(){
        $UserModel = new User();
        $users = $UserModel->getAllUsers();
        $CategoryModel = new Category();
        $Categorys = $CategoryModel->getCategory();
        $TagModel = new Tag();
        $Tags = $TagModel->getTag();
        require 'view/task_create_form.php';
    }

    public function deleteTask($idTask,$idProject) {
        $this->taskModel->delete($idTask);
        header("location: index.php?action=kanban&id=". $idProject);
    }
    public function EditTask($idProject,$idTask,$name, $description,$status){
        $this->taskModel->edit($idTask,$name,$description,$status);
        header("location: index.php?action=kanban&id=". $idProject);
    }

    public function EditRoleAndPermission($user_id,$project_id,$role,$permissions){
        $this->taskModel->editRolePermission($user_id,$project_id,$role,$permissions);
        header("location: index.php?action=kanban&id=". $project_id);
    }
}

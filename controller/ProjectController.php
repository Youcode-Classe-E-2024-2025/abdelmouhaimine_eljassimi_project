<?php

require_once "model/ProjectModel.php";


class ProjectController {
    private $projectModel;
    private $PermissionModel;

    public function __construct() {
        $this->projectModel = new Project();
        $this->PermissionModel = new Permissions();
    }


    public function createProject($name, $description,$users,$accesiblity) {
        $this->projectModel->create($name, $description,$users,$accesiblity);
        header("location: index.php?action=list");
    }

    public function showProjects() {
        $userId = $_SESSION['user_id'];
         $roleId = $_SESSION['user_role'];
        $projects = $this->projectModel->getAll($userId, $roleId);
        $permissions = $this->PermissionModel->getPermissions($roleId);
        require 'view/project_list.php';
    }
    public function showVisitorProjects(){
        $projects = $this->projectModel->getVisitorAll();
        require 'view/project_list.php';
    }

    public function ShowEditForm($id){
        require 'view/project_edit_form.php';
        exit();
    }

    public function editProject($name,$description,$id) {
        $this->projectModel->update($name, $description, $id);
        header("location: index.php?action=list");
    }

    public function deleteProject($id) {
        $this->projectModel->delete($id);
        header("location: index.php?action=list");
    }
    public function DeleteMember($idUser,$idProject){
        $this->projectModel->deletemember($idUser,$idProject);
        header("location: index.php?action=kanban&id=". $idProject);
    }

    public function ShowDescription($id){
        $description = $this->projectModel->GetDescription($id);
        require "view/projectDescription.php";

    }
    public function googleSheet($id){
        $projects = $this->projectModel->GenerateSheet($id);
        require "google-sheet.php";
    }
}

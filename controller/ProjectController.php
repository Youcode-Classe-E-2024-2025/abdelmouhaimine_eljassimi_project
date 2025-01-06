<?php

require_once "model/ProjectModel.php";


class ProjectController {
    private $projectModel;

    public function __construct() {
        $this->projectModel = new Project(); 
    }


    public function createProject($name, $description,$users,$accesiblity) {
        $this->projectModel->create($name, $description,$users,$accesiblity);
        header("location: index.php?action=list");
    }

    public function showProjects() {
        $projects = $this->projectModel->getAll();
        require 'view/project_list.php';
    }
    public function showVisitorProjects(){
        $projects = $this->projectModel->getVisitorAll();
        require 'view/project_list.php';
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
}

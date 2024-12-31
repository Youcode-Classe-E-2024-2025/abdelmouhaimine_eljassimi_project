<?php

require_once "model/ProjectModel.php";


class ProjectController {
    private $projectModel;

    public function __construct() {
        $this->projectModel = new Project(); 
    }


    public function createProject($name, $description) {
        $this->projectModel->create($name, $description);
        header("location: index.php");
    }

    public function showProjects() {
        $projects = $this->projectModel->getAll();
        require 'view/project_list.php';
    }

    public function editProject($name,$description,$id) {
        $this->projectModel->update($name, $description, $id);
        header("location: index.php");
    }
}

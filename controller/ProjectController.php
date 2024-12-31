<?php

require_once "model/ProjectModel.php";


class ProjectController {
    private $projectModel;

    public function __construct() {
        $this->projectModel = new Project(); 
    }


    public function createProject($name, $description, $deadline) {
        $this->projectModel->create($name, $description, $deadline);
        header("Location: /projects");
    }

    public function showProjects() {
        $projects = $this->projectModel->getAll();
        include 'view/project_list.php';
    }
}

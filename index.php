<?php
require_once "config.php";
require_once "controller/ProjectController.php";

$projectModel = new ProjectController();

$action = $_GET["action"]??"list";

switch ($action) {
    case "list": $projectModel->showProjects(); break;
    
    case "create_project": 
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $name = $_POST["name"];
            $description = $_POST["description"];
            $projectModel->createProject($name, $description);
        }
    break;
    case "edit_project": 
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $name = $_POST["name"];
            $description = $_POST["description"];
            $id = $_POST["id"];
            $projectModel->editProject($name, $description,$id);
        }
        break;
    case "delete_project":
        $id= $_GET["id"];
        $projectModel->deleteProject($id);
        break;
}
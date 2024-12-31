<?php
require_once "config.php";
require_once "controller/ProjectController.php";
require_once "controller/UserController.php";
require_once "controller/TaskController.php";


$projectModel = new ProjectController();
$userModel = new UserController();
$TaskModel = new TaskController();


$action = $_GET["action"]??"list";

switch ($action) {
    case "list": $projectModel->showProjects(); break;

    case "create": $userModel->AfficheUsers(); break;

    case "create_project": 
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $name = $_POST["name"];
            $description = $_POST["description"];
            $users = $_POST["users"];
            $projectModel->createProject($name, $description,$users);
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
    case "kanban":
        $id = $_GET["id"];
        $TaskModel->showProjects($id);
        break;
}
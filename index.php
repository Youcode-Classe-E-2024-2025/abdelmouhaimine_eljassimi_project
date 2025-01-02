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
        case "create_task":
            $TaskModel->afficheTaksForm();
        break;
        case "createTask":
            $project_id = $_GET["id"];
            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                $name = $_POST["name"];
                $description = $_POST["description"];
                $status = $_POST["status"];
                $due_date = $_POST["due_date"];
                $category = $_POST["category"];
                $TaskModel->createTask($project_id,$name, $description, $category,$status, $due_date);
            }
        break;
        case "deleteTask":
                $idTask = $_GET["idTask"];
                $idProject = $_GET["idProject"];
                $TaskModel->deleteTask($idTask, $idProject);
        break;
        case "editForm": 
            $idTask = $_GET["idTask"];
            $idProject = $_GET["idProject"];
            $TaskModel->editFrom($idTask, $idProject);
        break;
        case "EditTask":
            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                $name = $_POST["name"];
                $idTask = $_POST["taskid"];
                $idProject = $_POST["projectid"];
                $description = $_POST["description"];
                $status = $_POST["status"];
            }
            $TaskModel->EditTask($idProject,$idTask,$name, $description, $status);

}
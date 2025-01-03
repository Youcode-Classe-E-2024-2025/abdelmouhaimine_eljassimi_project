<?php
require_once "config.php";
require_once "controller/ProjectController.php";
require_once "controller/UserController.php";
require_once "controller/TaskController.php";


$projectModel = new ProjectController();
$userController = new UserController();
$TaskController = new TaskController();

$action = $_GET["action"]??"SignFrom";

switch ($action) {
    case "list": $projectModel->showProjects(); break;

    case "create": $userController->AfficheUsers(); break;

    case "create_project": 
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $name = $_POST["name"];
            $description = $_POST["description"];
            $accesiblity = $_POST["accesibility"];
            $users = $_POST["users"];
            $projectModel->createProject($name, $description,$users,$accesiblity);
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
        $TaskController->showProjects($id);
        break;
        case "create_task":
            $TaskController->afficheTaksForm();
        break;
        case "createTask":
            $project_id = $_GET["id"];
            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                $name = $_POST["name"];
                $description = $_POST["description"];
                $status = $_POST["status"];
                $due_date = $_POST["due_date"];
                $category = $_POST["category"];
                $user_id = $_POST["users"];
                $tag = $_POST["tag"];
                $TaskController->createTask($project_id,$name, $description, $category,$status, $due_date,$user_id,$tag);
            }
        break;
        case "deleteTask":
                $idTask = $_GET["idTask"];
                $idProject = $_GET["idProject"];
                $TaskController->deleteTask($idTask, $idProject);
        break;
        case "editForm": 
            $idTask = $_GET["idTask"];
            $idProject = $_GET["idProject"];
            $TaskController->editFrom($idTask, $idProject);
        break;
        case "EditTask":
            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                $name = $_POST["name"];
                $idTask = $_POST["taskid"];
                $idProject = $_POST["projectid"];
                $description = $_POST["description"];
                $status = $_POST["status"];
                $TaskController->EditTask($idProject,$idTask,$name, $description, $status);
            }
            break;
            case "SignFrom":
                if(!isset($SESSION["user_id"])){
                $userController->signForm();
                }else{
                    header("index.php?action=404");
                }
                break;
            case "signin":
                if($_SERVER["REQUEST_METHOD"]==="POST"){
                    $email = $_POST["email"];
                    $password = $_POST["password"];
                    $userController->signin($email, $password);
                }
                break;
                case "logout":
                    $userController->logOut();
                    break;
                case "signupForm":
                    $userController->signupForm();
                    break;
            case "signup":
                if($_SERVER["REQUEST_METHOD"]==="POST"){
                    $email = $_POST["email"];
                    $name = $_POST["name"];
                    $password = $_POST["password"];
                    $userController->signup($name, $email, $password);
                }
                break;
            case "404":
            require "view/404.php";
            break;

}
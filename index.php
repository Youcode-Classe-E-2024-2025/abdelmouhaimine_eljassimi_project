<?php
require_once "config.php";
require_once "controller/ProjectController.php";

$projectModel = new ProjectController();

$action = $_GET["action"]??"list";

switch ($action) {
    case "list": $projectModel->showProjects(); break;
}
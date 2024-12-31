<?php

require_once "model/UserModel.php";


class UserController {
    private $UserModel;

    public function __construct() {
        $this->UserModel = new User(); 
    }

    public function AfficheUsers(){
        $users = $this->UserModel->getAllUsers();
        require 'view/project_create_form.php';
    }
     
}

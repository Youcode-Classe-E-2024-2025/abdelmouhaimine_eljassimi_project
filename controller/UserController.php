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

    public function signForm(){
        require 'view/signin.php';
    }

    public function signin($email, $password) {
        if ($this->UserModel->signinCheck($email, $password)) {
            $user = $this->UserModel->getUserByEmail($email);
            session_start();
            $_SESSION['user_email'] = $email;
            $_SESSION['user_role'] = $user['role'];
            $_SESSION['user_id'] = $user['id'];
            header("location: index.php?action=list");
            exit;
        }else{
            header("location: index.php?action=404");
        }
    }

    public function signupForm(){
        require 'view/signup.php';
    }

    public function signup($name, $email, $password) {
        $this->UserModel->SignUp($name, $email, $password);
        $user = $this->UserModel->getUserByEmail($email);
        
            $_SESSION['user_email'] = $email;
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_role'] = $user['role'];
        header("location: index.php?action=list");
    }
   
    public function logOut() {
        session_unset();
        session_destroy();
        header("Location: index.php?action=SignFrom");
        exit;
    }
    
    
     
}

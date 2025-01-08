<?php

require_once "model/RoleModel.php";


class RoleController{
    private $RoleModel;

    public function __construct() {
        $this->RoleModel = new Role(); 
    }


    public function EditRolePermissions($roleId,$permissions){
        $this->RoleModel->EditePermissions($roleId,$permissions);
        header("location: ?action=permissions");
    }

    public function CreateRole($rolename,$permissions){
        $this->RoleModel->createrole($rolename,$permissions);
        header("location: ?action=permissions");
    }

    public function DisplayRole(){
        $roles = $this->RoleModel->role();
        require_once "view/EditRole.php";
    }
}


?>
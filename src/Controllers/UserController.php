<?php

namespace Controllers;

use Controllers\BaseController;
use Models\UserTypeModel;

class UserController extends BaseController
{
    private $userTypeModel;

    public function __construct() {
        $this->userTypeModel = new UserTypeModel();
    }

    public function registerForm() {

        // Fetch roles from the model
        $roles = $this->userTypeModel->getAllRoles();

        // Filter out the 'admin' role
        $roles = array_filter($roles, function ($role) {
            return strtolower($role['user_type_name']) !== 'admin';
        });

        // Load the view and pass roles to it
        require_once __DIR__ . '/../views/Register.php';
    }
}
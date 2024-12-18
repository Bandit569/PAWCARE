<?php

namespace Controllers;

use Controllers\BaseController;
use Models\UserModel;

class LoginController extends BaseController
{

    private $UserLoginModel;

    public function authenticate()
    {
        $UserLoginModel = new UserModel();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userid = $_POST['username'];
            $password = $_POST['password'];

            $authenticatedUser = $UserLoginModel->authenticateUser($userid);

            if ($authenticatedUser && password_verify($password, $authenticatedUser['password'])) {
                session_start();
                $_SESSION['user_id'] = $authenticatedUser['user_id'];
                $_SESSION['user_type'] = $authenticatedUser['user_type'];

                header("Location: /Home.php");
                exit();
            } else {
                echo 'Invalid email or password';
            }
        }
    }

    public function login(){
        $this -> view('login');
    }

}
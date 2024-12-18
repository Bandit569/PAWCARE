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

            if ($authenticatedUser && $password == $authenticatedUser['password']) {
                session_start();
                // echo "Session started!";
                $_SESSION['user_id'] = $authenticatedUser['user_id'];
                $_SESSION['user_type'] = $authenticatedUser['user_type'];
/*
                echo $_SESSION['user_id'];
                echo $_SESSION['user_type'];*/

                header("Location: /PAWCARE/Home.php");
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
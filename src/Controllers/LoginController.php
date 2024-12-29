<?php

namespace Controllers;

use Controllers\BaseController;
use Models\UserModel;

class LoginController extends BaseController
{

    private $UserLoginModel;

    public function authenticate(): void
    {
        $UserLoginModel = new UserModel();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userid = $_POST['userid'];
            $password = $_POST['password'];
            $authenticatedUser = $UserLoginModel->authenticateUser($userid);
            // echo "Inside authenticate function!";
            //var_dump($authenticatedUser);
            if ($password == $authenticatedUser[0]['user_password']) {
                session_start();
                //echo "Session started!";
                $_SESSION['user_id'] = $authenticatedUser[0]['user_id'];
                $_SESSION['user_type'] = $authenticatedUser[0]['user_type'];
                /*echo $_SESSION['user_id'];
                echo $_SESSION['user_type'];*/
                //header("Location: /Home");
                 $this -> view('Home');
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
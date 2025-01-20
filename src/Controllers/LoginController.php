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
            $userid = htmlspecialchars(trim($_POST['userid']));
            $password = htmlspecialchars(trim($_POST['password']));
            $authenticatedUser = $UserLoginModel->authenticateUser($userid);
            // echo "Inside authenticate function!";
            //var_dump($authenticatedUser);
            if ($password == $authenticatedUser[0]['user_password']) {
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                //echo "Session started!";
                // Store user details in session
                $_SESSION['user'] = [
                    'id' => $authenticatedUser[0]['user_id'],
                    'first_name' => $authenticatedUser[0]['user_first_name'], // Assuming 'user_name' is the field for the user's name
                    'last_name' => $authenticatedUser[0]['user_last_name'],
                    'role' => $authenticatedUser[0]['user_type'], // User role, if needed
                ];



                //header("Location: /Home");
                 $this -> view('Home');
                 exit();
            } else {
                $this->view('login', ['error' => 'Invalid email or password.']);
            }
        }
    }

    public function login(){
        $this -> view('login');
    }

}
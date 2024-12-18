<?php

namespace Controllers;

use Controllers\BaseController;

class LoginController extends BaseController
{
    public function authenticate()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $user = $this->model('User');
            $authenticatedUser = $user->loginUser($username);

            if ($authenticatedUser && password_verify($password, $authenticatedUser['password'])) {
                session_start();
                $_SESSION['user_id'] = $authenticatedUser['id'];
                $_SESSION['role'] = $authenticatedUser['role'];

                /*                if ($authenticatedUser['role'] === 'owner') {
                                    header('Location: /PetOwnerController/dashboard');
                                } else if ($authenticatedUser['role'] === 'caretaker') {
                                    header('Location: /CaretakerController/dashboard');
                                }*/
            } else {
                echo 'Invalid email or password';
            }
        }
    }

    public function login(){
        $this -> view('login');
    }

}
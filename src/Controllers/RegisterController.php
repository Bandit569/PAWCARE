<?php

namespace Controllers;

use Controllers\BaseController;
use Models\UserModel;

class RegisterController extends BaseController
{
    public function registerUser(): void
    {
        $UserRegisterModel = new UserModel();
        if($_SERVER['REQUEST_METHOD'] === 'POST')
        {

            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $email = $_POST['email'];
            $contactno = $_POST['contactno'];
            $username = $_POST['username'];
            //$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $password = $_POST['password'];
            //$user = $this->model('User');
            $usertype = $_POST['role'];
            $lastInsertedUserId = $UserRegisterModel->registerUser($firstname, $lastname, $email, $contactno, $username, $password, $usertype);
            if ($lastInsertedUserId) {
                $this -> view('login');
            } else {
                echo "Registration failed. Please try again.";
            }
        }
    }
    public function register() {
        $this -> view('register');
    }
}
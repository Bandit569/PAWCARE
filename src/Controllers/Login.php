<?php

class Login
{
   /* public function index()
    {
        $this->view('/index');
    }*/

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
                $_SESSION['user_name'] = $authenticatedUser['name'];
                header('Location: /Home');
            } else {
                echo 'Invalid email or password';
            }
        }
    }
}

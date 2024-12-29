<?php

namespace Controllers;

use Controllers\BaseController;

class RegisterController extends BaseController
{
    public function store()
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $email = $_POST['email'];
            $contactno = $_POST['contactno'];
            $username = $_POST['username'];
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $user = $this->model('User');
            $user->registerUser($firstname, $lastname, $email, $contactno, $username, $password);
            header('Location: /LoginController');

        }
    }

    public function deleteid(){
        $this -> view('register');
        $this -> addParam('lemoncake',$_GET['id']);
}
}
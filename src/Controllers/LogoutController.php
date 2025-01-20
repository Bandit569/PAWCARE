<?php

namespace Controllers;

class LogoutController
{
    public function logout(): void
    {
        // Start session if not already started
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Validate CSRF token
//        if ($_GET['csrf_token'] !== $_SESSION['csrf_token']) {
//            die("CSRF token validation failed.");
//        }

        // Unset session variables and destroy session
        session_unset();
        session_destroy();

        // Redirect to login page
        header("Location: /PAWCARE/login");
        //$this -> view('/PAWCARE/Home');
        exit();
    }
}
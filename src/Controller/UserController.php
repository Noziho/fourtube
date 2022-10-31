<?php

namespace App\Controller;

use App\Model\Manager\UserManager;

class UserController extends AbstractController
{

    public function index()
    {
        // TODO: Implement index() method.
    }


    public static function register ()
    {
        self::render('user/register');

        if (isset($_POST['submit'])) {
            if (!self::formIsset('email', 'username', 'password', 'password_repeat')) {
                header("Location: /?c=home&f=0");
                exit();
            }

            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $username= filter_var($_POST['username'], FILTER_SANITIZE_STRING);

            $password = password_hash($_POST['password'], PASSWORD_ARGON2I);
            $password_repeat = $_POST['password_repeat'];

            if (!password_verify($password_repeat, $password)) {
                header("Location: /?c=home&f=2");
                exit();
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                header("Location: /?c=home&f=1");
                exit();
            }

            if (!UserManager::register($email, $username, $password))
            {
                header("Location: /?c=user&a=register&f=0");
                exit();
            }

            header("Location: /?c=user&a=login");
            exit();


        }
    }

    public static function login ()
    {
        self::render('user/login');

        if (isset($_POST['submit'])) {
            if (!self::formIsset('email', 'password')) {
                header("Location: /?c=user&a=login&f=0");
                exit();
            }

            $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
            $password = $_POST['password'];

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                header("Location: /?c=user&a=login&f=2");
                exit();
            }


            UserManager::login($email, $password);

        }
    }

}
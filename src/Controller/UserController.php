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
            $clear_password = $_POST['password'];
            $password_repeat = $_POST['password_repeat'];

            self::rangeCheck(6, 150, $email, '/?c=user&a=register&f=LongueurMail');
            self::rangeCheck(4, 40, $username, '/?c=user&a=register&f=LongueurPseudo');
            self::rangeCheck(8, 30, $password_repeat, '/?c=user&a=register&f=LongueurPassword');

            if (UserManager::mailExist($email)) {
                header("Location: /?c=user&a=register&f=LeMailExisteDeja");
                exit();
            }

            if ($clear_password !== $password) {
                header("Location: /?c=user&a=register&f=PasswordPasEgaux");
                exit();
            }

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

            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'];

            UserManager::login($email, $password);

        }
    }

    public function logOut ()
    {
        if (!isset($_SESSION['current_user'])) {
            header("Location: /?c=home");
        }

        session_destroy();
        header("Location: /?c=home&f=LogOut");
    }

}
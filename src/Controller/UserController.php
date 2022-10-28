<?php

namespace App\Controller;

class UserController extends AbstractController
{

    public function index()
    {
        // TODO: Implement index() method.
    }

    public static function login ()
    {
        self::render('user/login');
    }

    public static function register ()
    {
        self::render('user/register');
    }
}
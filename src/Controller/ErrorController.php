<?php

namespace App\Controller;

class ErrorController extends AbstractController
{

    public function index()
    {
        // TODO: Implement index() method.
    }

    public function error404 ()
    {
        self::render('error/error404');
    }


}

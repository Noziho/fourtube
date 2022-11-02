<?php

namespace App\Controller;


use App\Model\Manager\VideoManager;

class HomeController extends AbstractController
{

    public function index()
    {
        self::render('home/home', [
            'video' => VideoManager::getAll(),
        ]);
    }
}

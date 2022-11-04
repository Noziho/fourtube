<?php

namespace App\Controller;

use App\Model\Manager\CommentsManager;
use App\Model\Manager\VideoManager;

class CommentsController extends AbstractController
{

    public function index()
    {

    }

    public static function addComments (int $id = null) {

        if (null === $id) {
            header("Location: /?c=home");
            exit();
        }


        $video_fk = VideoManager::getVideoByUserId($id)->getId();
        $content = filter_var($_POST['comments'], FILTER_SANITIZE_STRING);

        if (CommentsManager::addComments($content, $video_fk, $id)) {
            header("Location: /?c=home");
            exit();
        }

    }
}
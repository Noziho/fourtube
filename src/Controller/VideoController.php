<?php

namespace App\Controller;

use App\Model\Manager\UserManager;
use App\Model\Manager\VideoManager;
use Exception;

class VideoController extends AbstractController
{


    public function index()
    {
        self::render('user/add_video', [
            "video" => VideoManager::getAll(),
        ]);
    }

    public function getRandomName(string $fileName): string
    {
        $infos = pathinfo($fileName);

        try {
            $bytes = random_bytes(15);
        }
        catch (Exception $e) {
            $bytes = openssl_random_pseudo_bytes(15);
        }

        return bin2hex($bytes). '.' .$infos['extension'];
    }

    public function addVideo ()
    {
        if (isset($_FILES['userVideoFile'])) {


            $tmp_name = $_FILES['userVideoFile']['tmp_name'];
            $video_name = $this->getRandomName($_FILES['userVideoFile']['name']);
            if (!is_dir('assets/video/')) {
                mkdir('assets/video/', '0755');
            }

            move_uploaded_file($tmp_name, 'assets/video/'. $video_name);

            $sanitize_video_name = preg_replace('/\\.[^.\\s]{2,4}$/', '', $video_name);

            $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
            $description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);

            $user = UserManager::getUserById($_SESSION['user']->getId());

            if (VideoManager::addVideo($sanitize_video_name, $title, $description, $user->getId())) {
                header("Location: /?c=video&f=sucess");

            }else {
                header("Location: /?c=video&f=error");
            }

        }

    }

    public function showVideo (int $id)
    {
        self::render('video/video', [
            'video' => VideoManager::getVideoById($id),
        ]);
    }
}
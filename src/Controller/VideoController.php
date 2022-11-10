<?php

namespace App\Controller;

use App\Model\Entity\Video;
use App\Model\Manager\CommentsManager;
use App\Model\Manager\UserManager;
use App\Model\Manager\VideoManager;
use Exception;

class VideoController extends AbstractController
{


    public function index()
    {
        if (!isset($_SESSION['user'])) {
            header("Location: /?c=home");
            exit();
        }
        self::render('user/add_video', [
            "video" => VideoManager::getAll(),
        ]);
    }

    public function getRandomName(string $fileName): string
    {
        $infos = pathinfo($fileName);

        try {
            $bytes = random_bytes(15);
        } catch (Exception $e) {
            $bytes = openssl_random_pseudo_bytes(15);
        }

        return bin2hex($bytes) . '.' . $infos['extension'];
    }

    public function addVideo()
    {
        if (!isset($_SESSION['user'])) {
            header("Location: /?c=home");
            exit();
        }
        if (isset($_FILES['userVideoFile'])) {


            $tmp_name = $_FILES['userVideoFile']['tmp_name'];
            $video_name = $this->getRandomName($_FILES['userVideoFile']['name']);
            if (!is_dir('../assets/video/')) {
                mkdir('../assets/video/', '0755');
            }

            if (AbstractController::checkMimeType($tmp_name)) {
                move_uploaded_file($tmp_name, '../assets/video/' . $video_name);

                $sanitize_video_name = preg_replace('/\\.[^.\\s]{2,4}$/', '', $video_name);

                $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
                $description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);

                self::rangeCheck(8, 30, $title, '/?c=video&a=video&f=MauvaiseLongueurDeTitre');
                self::rangeCheck(8, 30, $description, '/?c=video&a=video&f=MauvaiseLongueurDeDescription');

                $user = UserManager::getUserById($_SESSION['user']->getId());

                if (VideoManager::addVideo($sanitize_video_name, $title, $description, $user->getId())) {
                    header("Location: /?c=home&f=sucessUpload");

                } else {
                    header("Location: /?c=video&f=error");
                    exit();
                }
            }
            else {
                header("Location: /?c=home");
                exit();
            }
        }


    }

    public function showVideo(int $id = null)
    {
        if (null === $id) {
            header("Location: /?c=home");
            exit();
        }
        if (VideoManager::videoExist($id)) {
            self::render('video/video', [
                'video' => VideoManager::getVideoById($id),

            ]);
        } else {
            header("Location: /?c=home");
        }
    }

    public function deleteVideo(int $video_id = null)
    {

        if (null === $video_id) {
            header("Location: /?c=home");
            exit();
        }

        $video = VideoManager::getVideoById($video_id)->getAuthor()->getId();
        $user = $_SESSION['user']->getId();

        if ($video === $user) {
            VideoManager::deleteVideoById($video_id);
            header("Location: /?c=user&a=profil&id=$user");
            exit();
        }


    }
}
<?php

namespace App\Model\Manager;

use App\Model\DB_Connect;
use App\Model\Entity\Comments;
use App\Model\Entity\User;

class CommentsManager
{

    const TABLE = "ndmp22_comments";

    public static function makeComments (array $data): Comments
    {
        return (new Comments())
            ->setId($data['id'])
            ->setContent($data['content'])
            ->setUserFk(UserManager::getUserById($data['user_fk']))
            ->setVideoFk(VideoManager::getVideoById($data['video_fk']))
            ;

    }

    public static function addComments (string $contents, int $video_fk, int $user_fk):bool
    {
        $stmt = DB_Connect::dbConnect()->prepare("
            INSERT INTO ".self::TABLE."(content, user_fk, video_fk)
            VALUES (:content, :user_fk, :video_fk)"
        );

        $stmt->bindParam(":content", $contents);
        $stmt->bindParam(":user_fk", $user_fk);
        $stmt->bindParam(":video_fk", $video_fk);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public static function getAllCommentsByVideoId (int $video_fk): array
    {
        $data = [];
        $query = DB_Connect::dbConnect()->query("SELECT * FROM " . self::TABLE." WHERE video_fk = $video_fk ORDER BY id DESC");
        if ($query) {
            foreach ($query->fetchAll() as $video) {
                $data[] = self::makeComments($video);
            }
        }
        return $data;
    }
}
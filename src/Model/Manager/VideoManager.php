<?php

namespace App\Model\Manager;

use App\Model\DB_Connect;
use App\Model\Entity\Video;

class VideoManager
{
    const TABLE = "ndmp22_video";

    /**
     * @param array $data
     * @return Video
     */
    public static function makeVideo(array $data): Video
    {
        return (new Video())
            ->setId($data['id'])
            ->setVideoName($data['video_name'])
            ->setTitle($data['title'])
            ->setDescription($data['description'])
            ->setAuthor(UserManager::getUserById($data['user_fk']));
    }

    /**
     * @return array
     */
    public static function getAll(): array
    {
        $data = [];
        $query = DB_Connect::dbConnect()->query("SELECT * FROM " . self::TABLE." ORDER BY id DESC");
        if ($query) {
            foreach ($query->fetchAll() as $video) {
                $data[] = self::makeVideo($video);
            }
        }
        return $data;
    }

    public static function addVideo(string $video_name,string $title, string $description, int $user_fk): bool
    {
        $stmt = DB_Connect::dbConnect()->prepare(
            "INSERT INTO ".self::TABLE."(video_name, title, description, user_fk)
        VALUES(:video_name, :title, :description, :user_fk)
        ");

        $stmt->bindParam(':video_name', $video_name);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':user_fk', $user_fk);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public static function getVideoById($video_id): ?Video
    {
        $query = DB_Connect::dbConnect()->query("SELECT * FROM ".self::TABLE." WHERE id = $video_id");
        return $query->execute() ? self::makeVideo($query->fetch()) : null;

    }

    public static function videoExist (int $id)
    {
        $query = DB_Connect::dbConnect()->query("SELECT count(*) as cnt FROM ".self::TABLE." WHERE id = $id");
        return $query ? $query->fetch()['cnt'] : 0;
    }
}
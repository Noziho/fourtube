<?php

namespace App\Model\Manager;

use App\Model\DB_Connect;

class CommentsManager
{

    const TABLE = "ndmp22_comments";

    public static function makeComments ()
    {

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
}
<?php

use App\Model\Entity\Comments;
use App\Model\Entity\User;
use App\Model\Entity\Video;
use App\Model\Manager\CommentsManager;

if (isset($data['video'])) {
    /** @var Video $video **/
    /** @var User $user */
    $video = $data['video'];
    $comments = CommentsManager::getAllCommentsByVideoId($video->getId());
}

?>

<div class="main_container">
    <video id="single_video" src="/assets/video/<?= $video->getVideoName() ?>.mp4 " controls width="100%"></video>
    <p><?= $video->getTitle() ?></p>
    <p><?= $video->getAuthor()->getUsername() ?></p>
    <div id="container_comments">
        <h2>Commentaires:</h2>
    <?php
        foreach ($comments as $comment) {
            /** @var Comments $comment */?>

                <div>
                    <p><?= $comment->getUserFk()->getUsername() ?></p>
                    <p><?= $comment->getContent() ?></p>
                </div>
            <?php
        }
    ?>
    </div>
    <?php
        if (isset($_SESSION['user'])) {
            $user = $_SESSION['user']?>
            <form id="comments_form" action="/?c=comments&a=add-comments&id=<?= $user->getId()?>" method="post">
                <input type="text" id="comments" name="comments" placeholder="Commentaires ...">
            </form><?php
        }
    ?>



</div>
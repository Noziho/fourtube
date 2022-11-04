<?php

use App\Model\Entity\User;
use App\Model\Entity\Video;

if (isset($data['video'])) {
    /** @var Video $video **/
    /** @var User $user */
    $user = $_SESSION['user'];
    $video = $data['video'];
}

?>

<div class="main_container">
    <video id="single_video" src="/assets/video/<?= $video->getVideoName() ?>.mp4 " controls width="100%"></video>
    <p><?= $video->getTitle() ?></p>
    <p><?= $video->getAuthor()->getUsername() ?></p>

    <form id="comments_form" action="/?c=comments&a=add-comments&id=<?= $user->getId()?>" method="post">
        <input type="text" id="comments" name="comments" placeholder="Commentaires ...">
    </form>


</div>
<?php

use App\Model\Entity\Video;

if (isset($data['video'])) {
    /** @var Video $video **/
    $video = $data['video'];
}

?>

<div class="main_container">
    <video id="single_video" src="/assets/video/<?= $video->getVideoName() ?>.mp4 " controls width="100%"></video>
    <p><?= $video->getTitle() ?></p>
    <p><?= $video->getAuthor()->getUsername() ?></p>


</div>
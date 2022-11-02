<div class="main_container">


<?php

use App\Model\Entity\Video;

if (isset($data['video'])) {
    $videos = $data['video'];
}

foreach ($videos as $video) {
    /** @var Video $video **/?>
    <a class="video_container" href="/?c=video&a=showVideo&id=<?= $video->getId() ?>">
        <div>
            <video src="/assets/video/<?= $video->getVideoName() ?>.mp4"></video>
            <p><?= $video->getTitle() ?></p>
            <p><?= $video->getDescription() ?></p>
            <p><?= $video->getAuthor()->getUsername() ?></p>
        </div>
    </a>

<?php
}
?>
</div>
<?php

use App\Model\Entity\User;
use App\Model\Entity\Video;

if (isset($data['user']) && $data['videos']) {
    /** @var User $user**/
    $user = $data['user'];
    $videos = $data['videos'];

    if ($user->getId() !== $_SESSION['user']->getId()) {
        header("Location: /?c=home");
        exit();
    }
} ?>

<div class="profil_container">
    <div id="profil_info">
        <div>
            <h1>Mes infos:</h1>
            <div id="personal_info">
                <p><?= $user->getEmail() ?></p>
                <p><?= $user->getUsername() ?></p>
            </div>
            <h2 id="title_video">Mes vidéos: </h2>
            <?php
                foreach ($videos as $video) {
                    /** @var Video $video **/?>
                        <div>
                            <p><?= $video->getTitle() ?></p>
                            <p><?= $video->getDescription() ?></p>
                            <form action="/?c=video&a=delete-video&video_id=<?= $video->getId() ?>" method="post">
                                <button>Supprimer la vidéo</button>
                            </form>
                        </div><?php
                }
            ?>
        </div>
    </div>
</div>

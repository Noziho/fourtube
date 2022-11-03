<?php

use App\Model\Entity\User;

if (isset($data['user'])) {
    /** @var User $user**/
    $user = $data['user'];

    if ($user->getId() !== $_SESSION['user']->getId()) {
        header("Location: /?c=home");
        exit();
    }
} ?>

<div class="main_container">
    <div>
        <p><?= $user->getEmail() ?></p>
        <p><?= $user->getUsername() ?></p>
    </div>
</div>

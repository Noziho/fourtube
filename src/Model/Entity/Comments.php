<?php

namespace App\Model\Entity;

use App\Controller\AbstractController;

class Comments extends AbstractEntity
{
    private string $content;
    private User $user_fk;
    private Video $video_fk;

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return Comments
     */
    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return User
     */
    public function getUserFk(): User
    {
        return $this->user_fk;
    }

    /**
     * @param User $user_fk
     * @return Comments
     */
    public function setUserFk(User $user_fk): self
    {
        $this->user_fk = $user_fk;
        return $this;
    }

    /**
     * @return Video
     */
    public function getVideoFk(): Video
    {
        return $this->video_fk;
    }

    /**
     * @param Video $video_fk
     * @return Comments
     */
    public function setVideoFk(Video $video_fk): self
    {
        $this->video_fk = $video_fk;
        return$this;
    }


}
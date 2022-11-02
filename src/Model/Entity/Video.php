<?php

namespace App\Model\Entity;

class Video extends AbstractEntity
{

    private string $video_name;
    private string $title;
    private string $description;
    private User $author;

    /**
     * @return string
     */
    public function getVideoName(): string
    {
        return $this->video_name;
    }

    /**
     * @param string $video_name
     * @return Video
     */
    public function setVideoName(string $video_name): self
    {
        $this->video_name = $video_name;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Video
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Video
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return User
     */
    public function getAuthor(): User
    {
        return $this->author;
    }

    /**
     * @param User $author
     * @return Video
     */
    public function setAuthor(User $author): self
    {
        $this->author = $author;
        return $this;
    }




}
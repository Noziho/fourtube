<?php

namespace App\Model\Entity;

class Video extends AbstractEntity
{

    private string $name;
    private User $author;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Video
     */
    public function setName(string $name): self
    {
        $this->name = $name;
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
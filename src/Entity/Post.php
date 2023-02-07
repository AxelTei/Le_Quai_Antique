<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity()]
#[ORM\Table(name: "post")]
class Post
{
    #[ORM\Id()]
    #[ORM\Column(type: "integer")]
    private int $id;
    #[ORM\Column(type: "string", nullable: true, length: 150)]
    private ?string $title = NULL;
    #[ORM\Column(type: "text", length: 320)]
    private string $content;
    #[ORM\Column(type: "text")]
    private string $image;
    //#[ORM\Column(type: "User")]
    //private $user;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image): self
    {
        $this->image = $image;

        return $this;
    }

    // public function getUser()
    // {
    //     return $this->user;
    // }

    // public function setUser($user): self
    // {
    //     $this->user = $user;

    //     return $this;
    // }
}
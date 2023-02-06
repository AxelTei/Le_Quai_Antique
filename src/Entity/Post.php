<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Post
{
    private int $id;
    #[Assert\Length(min: 0, max: 150, minMessage: "Le titre doit faire plus de 5 caractères !", maxMessage: "Le titre doit faire moins de 320 caractères !")]
    private ?string $title = NULL;
    #[Assert\NotBlank(message: 'Le message ne doit pas être vide !')]
    #[Assert\Length(min: 5, max: 320, minMessage: "Le message doit faire plus de 5 caractères !", maxMessage: "Le message doit faire moins de 320 caractères !")]
    private string $content;
    #[Assert\NotBlank(message: 'L\'url de l\'image ne doit pas être vide !')]
    #[Assert\Url(message: 'Il doit s\'agir de l\'url d\'une image !')]
    private string $image;
    private $user;

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

    public function getUser()
    {
        return $this->user;
    }

    public function setUser($user): self
    {
        $this->user = $user;

        return $this;
    }
}
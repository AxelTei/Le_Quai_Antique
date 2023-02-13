<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity()]
#[ORM\Table(name: "restaurant_dishes")]
class Menu
{
    #[ORM\Id()]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    #[ORM\Column(type: "integer")]
    private int $id;

    #[ORM\Column(type: "string", length: 150)]
    private string $dishTitle;

    #[ORM\Column(type: "string", length: 150)]
    private string $dishCategory;

    #[ORM\Column(type: "text", length: 320)]
    private ?string $dishDescription;

    #[ORM\Column(type: "string", length: 30)]
    private ?string $dishPrice;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getDishTitle()
    {
        return $this->dishTitle;
    }

    public function setDishTitle($dishTitle)
    {
        $this->dishTitle = $dishTitle;

        return $this;
    }

    public function getDishCategory()
    {
        return $this->dishCategory;
    }

    public function setDishCategory($dishCategory)
    {
        $this->dishCategory = $dishCategory;

        return $this;
    }

    public function getDishDescription()
    {
        return $this->dishDescription;
    }

    public function setDishDescription($dishDescription)
    {
        $this->dishDescription = $dishDescription;

        return $this;
    }

    public function getDishPrice()
    {
        return $this->dishPrice;
    }

    public function setDishPrice($dishPrice)
    {
        $this->dishPrice = $dishPrice;

        return $this;
    }
}
<?php

namespace App\Entity;

use App\Repository\RestaurantPlacesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RestaurantPlacesRepository::class)]
#[ORM\Table(name: "restaurant_places")]
class RestaurantPlaces
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $activeDate = null;

    #[ORM\Column(length: 255)]
    private ?string $activeHour = null;

    #[ORM\Column]
    private ?int $numberOfSubmit;

    #[ORM\Column]
    private ?int $numberOfPlacesMax = 0;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Book $book = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getActiveDate(): ?string
    {
        return $this->activeDate;
    }

    public function setActiveDate(string $activeDate): self
    {
        $this->activeDate = $activeDate;

        return $this;
    }

    public function getNumberOfSubmit(): ?int
    {
        return $this->numberOfSubmit;
    }

    public function setNumberOfSubmit(int $numberOfSubmit): self
    {
        $this->numberOfSubmit = $numberOfSubmit;

        return $this;
    }

    public function getNumberOfPlacesMax(): ?int
    {
        return $this->numberOfPlacesMax;
    }

    public function setNumberOfPlacesMax(int $numberOfPlacesMax): self
    {
        $this->numberOfPlacesMax = $numberOfPlacesMax;

        return $this;
    }

    public function getActiveHour()
    {
        return $this->activeHour;
    }

    public function setActiveHour($activeHour)
    {
        $this->activeHour = $activeHour;

        return $this;
    }

    public function getBook(): ?Book
    {
        return $this->book;
    }

    public function setBook(Book $book): static
    {
        $this->book = $book;

        return $this;
    }
}

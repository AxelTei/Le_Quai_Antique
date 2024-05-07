<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity()]
#[ORM\Table(name: "restaurant_bookings")]
class Book
{
    #[ORM\Id()]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    #[ORM\Column(type: "integer")]
    private int $id;
    
    #[ORM\Column(type: "integer")]
    private int $preferedGroupNumber;

    #[ORM\Column(nullable: true)]
    private ?string $allergies;

    #[ORM\Column(type: "string", nullable: false)]
    private ?string $date;

    #[ORM\Column(nullable: true)]
    private ?string $hourSelectedDay;

    #[ORM\Column(nullable: true)]
    private ?string $hourSelectedNight;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $phoneNumber;

    #[ORM\Column(length: 180, nullable: false)]
    private ?string $alias;

    #[ORM\ManyToOne(inversedBy: 'books', targetEntity: Customers::class)]
    #[ORM\JoinColumn(nullable: false, onDelete: "CASCADE")]
    private ?Customers $customer = null;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getPreferedGroupNumber()
    {
        return $this->preferedGroupNumber;
    }

    public function setPreferedGroupNumber($preferedGroupNumber)
    {
        $this->preferedGroupNumber = $preferedGroupNumber;

        return $this;
    }

    public function getAllergies()
    {
        return $this->allergies;
    }

    public function setAllergies($allergies)
    {
        $this->allergies = $allergies;

        return $this;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    public function getHourSelectedDay()
    {
        return $this->hourSelectedDay;
    }

    public function setHourSelectedDay($hourSelectedDay)
    {
        $this->hourSelectedDay = $hourSelectedDay;

        return $this;
    }

    public function getHourSelectedNight()
    {
        return $this->hourSelectedNight;
    }

    public function setHourSelectedNight($hourSelectedNight)
    {
        $this->hourSelectedNight = $hourSelectedNight;

        return $this;
    }

    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getAlias()
    {
        return $this->alias;
    }

    public function setAlias($alias)
    {
        $this->alias = $alias;

        return $this;
    }

    public function getCustomer(): ?Customers
    {
        return $this->customer;
    }

    public function setCustomer(?Customers $customer): static
    {
        $this->customer = $customer;

        return $this;
    }
}
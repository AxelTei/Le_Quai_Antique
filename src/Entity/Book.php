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
    
    #[ORM\Column(type: "string", length: 150)]
    private ?string $date;

    #[ORM\Column(type: "string")]
    private ?string $preferedHour;

    #[ORM\Column(type: "boolean")]
    private ?bool $formulaDay = false;

    #[ORM\Column(type: "boolean")]
    private ?bool $formulaNight = false;

    #[ORM\Column(type: "integer")]
    private int $preferedGroupNumber;

    #[ORM\ManyToOne(targetEntity: "App\Entity\Customers", inversedBy: "bookings")]
    #[ORM\JoinColumn(name: "customers_email", referencedColumnName: "email", onDelete: "CASCADE")]
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

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    public function getPreferedHour()
    {
        return $this->preferedHour;
    }

    public function setPreferedHour($preferedHour)
    {
        $this->preferedHour = $preferedHour;

        return $this;
    }

    public function getFormulaDay()
    {
        return $this->formulaDay;
    }

    public function setFormulaDay($formulaDay)
    {
        $this->formulaDay = $formulaDay;

        return $this;
    }

    public function getFormulaNight()
    {
        return $this->formulaNight;
    }

    public function setFormulaNight($formulaNight)
    {
        $this->formulaNight = $formulaNight;

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

    public function getUser()
    {
        return $this->user;
    }

    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }
}
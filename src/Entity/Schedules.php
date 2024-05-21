<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity()]
#[ORM\Table(name: "restaurant_hours")]
class Schedules
{
    #[ORM\Id()]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    #[ORM\Column(type: "integer")]
    private int $id;

    #[ORM\Column(type: "string", length: 150)]
    private string $date;

    #[ORM\Column(type: "string", length: 30, nullable: true)]
    private string $openingHoursDay;

    #[ORM\Column(type: "string", length: 30, nullable: true)]
    private ?string $openingHoursNight;

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

    public function getOpeningHoursDay()
    {
        return $this->openingHoursDay;
    }

    public function setOpeningHoursDay($openingHoursDay)
    {
        $this->openingHoursDay = $openingHoursDay;

        return $this;
    }

    public function getOpeningHoursNight()
    {
        return $this->openingHoursNight;
    }

    public function setOpeningHoursNight($openingHoursNight)
    {
        $this->openingHoursNight = $openingHoursNight;

        return $this;
    }
}

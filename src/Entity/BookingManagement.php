<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity()]
#[ORM\Table(name: "restaurant_bookings_admin")]
class BookingManagement
{
    #[ORM\Id()]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    #[ORM\Column(type: "integer")]
    private int $id;
    
    #[ORM\Column(type: "string", length: 150)]
    private ?string $date;

    #[ORM\Column(type: "datetime")]
    private datetime $hourStart;

    #[ORM\Column(type: "datetime")]
    private datetime $hourEnd;

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

    public function gethourStart()
    {
        return $this->hourStart;
    }

    public function sethourStart($HourStart)
    {
        $this->hourStart = $HourStart;

        return $this;
    }

    public function gethourEnd()
    {
        return $this->hourEnd;
    }

    public function sethourEnd($HourEnd)
    {
        $this->hourEnd = $HourEnd;

        return $this;
    }
}
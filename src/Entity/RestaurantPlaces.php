<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity()]
#[ORM\Table(name: "restaurant_places")]
class RestaurantPlaces
{
    #[ORM\Id()]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    #[ORM\Column(type: "integer")]
    private int $id;
    
    #[ORM\Column(type: "integer")]
    private int $numberOfTablesAvailable;

    #[ORM\Column(type: "string")]
    private ?string $bookingDate;
    private ?bool $bookingHourDay;
    private ?bool $bookingHourNight;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getNumberOfTablesAvailable()
    {
        return $this->numberOfTablesAvailable;
    }

    public function setNumberOfTablesAvailable($numberOfTablesAvailable)
    {
        $this->numberOfTablesAvailable = $numberOfTablesAvailable;

        return $this;
    }

    public function getBookingDate()
    {
        return $this->bookingDate;
    }

    public function setBookingDate($bookingDate)
    {
        $this->bookingDate = $bookingDate;

        return $this;
    }

    public function getBookingHourDay()
    {
        return $this->bookingHourDay;
    }
 
    public function setBookingHourDay($bookingHourDay)
    {
        $this->bookingHourDay = $bookingHourDay;

        return $this;
    }

    public function getBookingHourNight()
    {
        return $this->bookingHourNight;
    }

    public function setBookingHourNight($bookingHourNight)
    {
        $this->bookingHourNight = $bookingHourNight;

        return $this;
    }
}
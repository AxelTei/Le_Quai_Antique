<?php

namespace App\Entity;

use App\Repository\RestaurantRuleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RestaurantRuleRepository::class)]
#[ORM\Table(name: "restaurant_rule")]
class RestaurantRule
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $closureDay = null;

    #[ORM\Column(length: 255)]
    private ?string $runMidi = null;

    #[ORM\Column(length: 255)]
    private ?string $runSoir = null;

    #[ORM\Column]
    private ?int $bookingLimit = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClosureDay(): ?string
    {
        return $this->closureDay;
    }

    public function setClosureDay(string $closureDay): self
    {
        $this->closureDay = $closureDay;

        return $this;
    }

    public function getRunMidi(): ?string
    {
        return $this->runMidi;
    }

    public function setRunMidi(string $runMidi): self
    {
        $this->runMidi = $runMidi;

        return $this;
    }

    public function getRunSoir(): ?string
    {
        return $this->runSoir;
    }

    public function setRunSoir(string $runSoir): self
    {
        $this->runSoir = $runSoir;

        return $this;
    }

    public function getBookingLimit(): ?int
    {
        return $this->bookingLimit;
    }

    public function setBookingLimit(int $bookingLimit): self
    {
        $this->bookingLimit = $bookingLimit;

        return $this;
    }
}

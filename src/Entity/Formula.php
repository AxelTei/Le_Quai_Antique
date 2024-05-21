<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
// Changer les bons attribut en nullable et migrer puis faire un test
#[ORM\Entity()]
#[ORM\Table(name: "restaurant_menu")]
class Formula
{
    #[ORM\Id()]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    #[ORM\Column(type: "integer")]
    private int $id;

    #[ORM\Column(type: "string", length: 150)]
    private string $menuTitle;

    #[ORM\Column(type: "string", length: 150, nullable: true)]
    private ?string $formulaDayTitle;

    #[ORM\Column(type: "text", length: 320, nullable: true)]
    private ?string $formulaDayDescription;

    #[ORM\Column(type: "string", length: 30, nullable: true)]
    private ?string $formulaDayPrice;
    #[ORM\Column(type: "string", length: 150, nullable: true)]
    private ?string $formulaNightTitle;

    #[ORM\Column(type: "text", length: 320, nullable: true)]
    private ?string $formulaNightDescription;

    #[ORM\Column(type: "string", length: 30, nullable: true)]
    private ?string $formulaNightPrice;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getMenuTitle()
    {
        return $this->menuTitle;
    }

    public function setMenuTitle($menuTitle)
    {
        $this->menuTitle = $menuTitle;

        return $this;
    }

    public function getFormulaDayTitle()
    {
        return $this->formulaDayTitle;
    }

    public function setFormulaDayTitle($formulaDayTitle)
    {
        $this->formulaDayTitle = $formulaDayTitle;

        return $this;
    }

    public function getFormulaDayDescription()
    {
        return $this->formulaDayDescription;
    }

    public function setFormulaDayDescription($formulaDayDescription)
    {
        $this->formulaDayDescription = $formulaDayDescription;

        return $this;
    }

    public function getFormulaDayPrice()
    {
        return $this->formulaDayPrice;
    }

    public function setFormulaDayPrice($formulaDayPrice)
    {
        $this->formulaDayPrice = $formulaDayPrice;

        return $this;
    }

    public function getFormulaNightTitle()
    {
        return $this->formulaNightTitle;
    }

    public function setFormulaNightTitle($formulaNightTitle)
    {
        $this->formulaNightTitle = $formulaNightTitle;

        return $this;
    }

    public function getFormulaNightDescription()
    {
        return $this->formulaNightDescription;
    }

    public function setFormulaNightDescription($formulaNightDescription)
    {
        $this->formulaNightDescription = $formulaNightDescription;

        return $this;
    }

    public function getFormulaNightPrice()
    {
        return $this->formulaNightPrice;
    }

    public function setFormulaNightPrice($formulaNightPrice)
    {
        $this->formulaNightPrice = $formulaNightPrice;

        return $this;
    }
}

<?php

namespace GlobalEmergency\Apuntate\Entity;

use GlobalEmergency\Apuntate\Repository\UnitComponentRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: UnitComponentRepository::class)]
class UnitComponent
{
    #[ORM\Id]
    #[ORM\Column(type: "uuid", unique: true)]
    private $id;

    #[ORM\ManyToOne(targetEntity: Unit::class, inversedBy: "unitComponents")]
    private $unit;

    #[ORM\Column(type: "integer")]
    private $quantity = 1;

    #[ORM\ManyToOne(targetEntity: Component::class, inversedBy: "unitComponents")]
    private $component;

    public function __construct()
    {
        $this->id = Uuid::v4();
    }

    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function getUnit(): ?Unit
    {
        return $this->unit;
    }

    public function setUnit(?Unit $unit): self
    {
        $this->unit = $unit;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getComponent(): ?Component
    {
        return $this->component;
    }

    public function setComponent(?Component $component): self
    {
        $this->component = $component;

        return $this;
    }

    public function __toString()
    {
        return $this->getUnit().' '.$this->getComponent();
    }
}

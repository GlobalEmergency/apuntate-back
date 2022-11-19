<?php

namespace GlobalEmergency\Apuntate\Entity;

use GlobalEmergency\Apuntate\Repository\UnitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Serializer\Annotation\MaxDepth;

/**
 * @ORM\Entity(repositoryClass=UnitRepository::class)
 */
class Unit
{
    /**
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $identifier;

    /**
     * @ORM\ManyToOne(targetEntity=Speciality::class, inversedBy="units")
     * @MaxDepth(1)
     */
    private ?Speciality $speciality;

    /**
     * @ORM\ManyToMany(targetEntity=Service::class, mappedBy="units")
     * @MaxDepth(1)
     */
    private $services;

    /**
     * @ORM\OneToMany(targetEntity=UnitComponent::class, mappedBy="unit")
     */
    private $unitComponents;

    public function __construct()
    {
        $this->id = Uuid::v4();
        $this->services = new ArrayCollection();
        $this->unitComponents = new ArrayCollection();
    }

    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getIdentifier(): string
    {
        return (is_null($this->identifier))? $this->getName() : $this->identifier;
    }

    public function setIdentifier(string $identifier): self
    {
        $this->identifier = $identifier;

        return $this;
    }

    public function getSpeciality(): ?Speciality
    {
        return $this->speciality;
    }

    public function setSpeciality(?Speciality $speciality): self
    {
        $this->speciality = $speciality;

        return $this;
    }

    /**
     * @return Collection|Service[]
     */
    public function getServices(): Collection
    {
        return $this->services;
    }

    public function addService(Service $service): self
    {
        if (!$this->services->contains($service)) {
            $this->services[] = $service;
            $service->addUnit($this);
        }

        return $this;
    }

    public function removeService(Service $service): self
    {
        if ($this->services->removeElement($service)) {
            $service->removeUnit($this);
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getIdentifier();
    }

    /**
     * @return Collection|UnitComponent[]
     */
    public function getUnitComponents(): Collection
    {
        return $this->unitComponents;
    }

    public function addUnitComponent(UnitComponent $unitComponent): self
    {
        if (!$this->unitComponents->contains($unitComponent)) {
            $this->unitComponents[] = $unitComponent;
            $unitComponent->setUnit($this);
        }

        return $this;
    }

    public function removeUnitComponent(UnitComponent $unitComponent): self
    {
        if ($this->unitComponents->removeElement($unitComponent)) {
            // set the owning side to null (unless already changed)
            if ($unitComponent->getUnit() === $this) {
                $unitComponent->setUnit(null);
            }
        }

        return $this;
    }

    public function componentsMax(){
        $max = 0;
        foreach($this->getUnitComponents() as $unitComponent){
            $max += $unitComponent->getQuantity();
        }
        return $max;
    }
}

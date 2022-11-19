<?php

namespace GlobalEmergency\Apuntate\Entity;

use GlobalEmergency\Apuntate\Repository\ComponentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;
use GlobalEmergency\Apuntate\Entity\Requirement;

/**
 * @ORM\Entity(repositoryClass=ComponentRepository::class)
 */
class Component
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
     * @ORM\ManyToMany(targetEntity=Requirement::class, inversedBy="components")
     */
    private $requirements;

    /**
     * @ORM\OneToMany(targetEntity=UnitComponent::class, mappedBy="component")
     */
    private $unitComponents;
    public function __construct()
    {
        $this->id = Uuid::v4();
        $this->requirements = new ArrayCollection();
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

    /**
     * @return Collection|requirement[]
     */
    public function getRequirements(): Collection
    {
        return $this->requirements;
    }

    public function addRequirement(requirement $requirement): self
    {
        if (!$this->requirements->contains($requirement)) {
            $this->requirements[] = $requirement;
        }

        return $this;
    }

    public function removeRequirement(requirement $requirement): self
    {
        $this->requirements->removeElement($requirement);

        return $this;
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
            $unitComponent->setComponent($this);
        }

        return $this;
    }

    public function removeUnitComponent(UnitComponent $unitComponent): self
    {
        if ($this->unitComponents->removeElement($unitComponent)) {
            // set the owning side to null (unless already changed)
            if ($unitComponent->getComponent() === $this) {
                $unitComponent->setComponent(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}

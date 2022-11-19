<?php

namespace GlobalEmergency\Apuntate\Entity;

use GlobalEmergency\Apuntate\Repository\SpecialityRepository;
use GlobalEmergency\Apuntate\Entity\Traits\Timestampable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UuidV4Generator;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Uid\UuidV4;

/**
 * @ORM\Entity(repositoryClass=SpecialityRepository::class)
 * @ORM\HasLifecycleCallbacks
 */
class Speciality
{
    use Timestampable;
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
    private $abbreviation;

    /**
     * @ORM\OneToMany(targetEntity=UserSpeciality::class, mappedBy="speciality", orphanRemoval=true)
     */
    private $userSpecialities;

    /**
     * @ORM\OneToMany(targetEntity=Unit::class, mappedBy="speciality")
     */
    private $units;

    public function __construct()
    {
        $this->userSpecialities = new ArrayCollection();
        $this->id = Uuid::v4();
        $this->units = new ArrayCollection();
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

    public function getAbbreviation(): ?string
    {
        return $this->abbreviation;
    }

    public function setAbbreviation(string $abbreviation): self
    {
        $this->abbreviation = $abbreviation;

        return $this;
    }

    /**
     * @return Collection|UserSpeciality[]
     */
    public function getUserSpecialities(): Collection
    {
        return $this->userSpecialities;
    }

    public function addUserSpeciality(UserSpeciality $userSpeciality): self
    {
        if (!$this->userSpecialities->contains($userSpeciality)) {
            $this->userSpecialities[] = $userSpeciality;
            $userSpeciality->setSpeciality($this);
        }

        return $this;
    }

    public function removeUserSpeciality(UserSpeciality $userSpeciality): self
    {
        if ($this->userSpecialities->removeElement($userSpeciality)) {
            // set the owning side to null (unless already changed)
            if ($userSpeciality->getSpeciality() === $this) {
                $userSpeciality->setSpeciality(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Unit[]
     */
    public function getUnits(): Collection
    {
        return $this->units;
    }

    public function addUnit(Unit $unit): self
    {
        if (!$this->units->contains($unit)) {
            $this->units[] = $unit;
            $unit->setSpeciality($this);
        }

        return $this;
    }

    public function removeUnit(Unit $unit): self
    {
        if ($this->units->removeElement($unit)) {
            // set the owning side to null (unless already changed)
            if ($unit->getSpeciality() === $this) {
                $unit->setSpeciality(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->getName();
    }
}

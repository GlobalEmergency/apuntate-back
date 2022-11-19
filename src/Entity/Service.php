<?php

namespace GlobalEmergency\Apuntate\Entity;

use Carbon\Carbon;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use GlobalEmergency\Apuntate\Entity\Traits\Timestampable;
use GlobalEmergency\Apuntate\Repository\ServiceRepository;
use Symfony\Component\Serializer\Annotation\MaxDepth;
use Symfony\Component\Uid\Uuid;

/**
 * @ORM\Entity(repositoryClass=ServiceRepository::class)
 * @ORM\HasLifecycleCallbacks
 */
class Service
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
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="carbon")
     */
    private $dateStart;

    /**
     * @ORM\Column(type="carbon")
     */
    private $dateEnd;

    /**
     * @ORM\Column(type="carbon")
     */
    private $datePlace;

    /**
     * @ORM\ManyToMany(targetEntity=Unit::class, inversedBy="services")
     * @MaxDepth(1)
     */
    private $units;

    /**
     * @ORM\OneToMany(targetEntity=Gap::class, mappedBy="service",cascade={"persist"})
     * @MaxDepth(1)
     */
    private $gaps;

    /**
     * @ORM\Column(type="serviceStatus")
     */
    private $status;

    public function __construct()
    {
        $this->id = Uuid::v4();
        $this->units = new ArrayCollection();
        $this->gaps = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDateStart(): ?Carbon
    {
        if ($this->dateStart instanceof \DateTime) {
            $this->dateStart = Carbon::instance($this->dateStart);
        }

        return $this->dateStart;
    }

    public function setDateStart(\DateTimeInterface $dateStart): self
    {
        if (!$dateStart instanceof Carbon) {
            $this->dateStart = Carbon::instance($dateStart);
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
        }

        return $this;
    }

    public function removeUnit(Unit $unit): self
    {
        $this->units->removeElement($unit);

        return $this;
    }

    /**
     * @return Collection|Gap[]
     */
    public function getGaps(): Collection
    {
        return $this->gaps;
    }

    public function addGap(Gap $gap): self
    {
        if (!$this->gaps->contains($gap)) {
            $this->gaps[] = $gap;
            $gap->setService($this);
        }

        return $this;
    }

    public function removeGap(Gap $gap): self
    {
        if ($this->gaps->removeElement($gap)) {
            // set the owning side to null (unless already changed)
            if ($gap->getService() === $this) {
                $gap->setService(null);
            }
        }

        return $this;
    }

    /**
     * @return Carbon
     */
    public function getDateEnd(): ?Carbon
    {
        return $this->dateEnd;
    }

    /**
     * @param Carbon $dateEnd
     */
    public function setDateEnd(\DateTime $dateEnd): self
    {
        if (!$dateEnd instanceof Carbon) {
            $this->dateEnd = Carbon::instance($dateEnd);
        }
        $this->dateEnd = $dateEnd;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDatePlace()
    {
        return $this->datePlace;
    }

    /**
     * @param mixed $datePlace
     *
     * @return Service
     */
    public function setDatePlace(\DateTime $datePlace)
    {
        if (!$datePlace instanceof Carbon) {
            $this->datePlace = Carbon::instance($datePlace);
        }

        $this->datePlace = $datePlace;

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }
}

<?php

namespace GlobalEmergency\Apuntate\Entity;

use GlobalEmergency\Apuntate\Entity\Traits\Timestampable;
use GlobalEmergency\Apuntate\Repository\GapRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: GapRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Gap
{
    use Timestampable;

    #[ORM\Id]
    #[ORM\Column(type: "uuid", unique: true)]
    private \Symfony\Component\Uid\UuidV4 $id;

    #[ORM\ManyToOne(targetEntity: Service::class, inversedBy: "gaps")]
    private ?Service $service;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: "gaps")]
    private ?User $user;

    #[ORM\ManyToOne(targetEntity: UnitComponent::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $unitComponent;

    public function __construct()
    {
        $this->id = Uuid::v4();
    }

    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function getService(): ?Service
    {
        return $this->service;
    }

    public function setService(?Service $service): self
    {
        $this->service = $service;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getUnitComponent(): ?UnitComponent
    {
        return $this->unitComponent;
    }

    public function setUnitComponent(?UnitComponent $unitComponent): self
    {
        $this->unitComponent = $unitComponent;

        return $this;
    }
}

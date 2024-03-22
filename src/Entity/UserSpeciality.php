<?php

namespace GlobalEmergency\Apuntate\Entity;

use GlobalEmergency\Apuntate\Entity\Traits\Timestampable;
use GlobalEmergency\Apuntate\Repository\UserSpecialityRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: UserSpecialityRepository::class)]
#[ORM\HasLifecycleCallbacks]
class UserSpeciality
{
    use Timestampable;

    #[ORM\Id]
    #[ORM\Column(type: "uuid", unique: true)]
    private $id;

    #[ORM\ManyToOne(targetEntity: Speciality::class, inversedBy: "userSpecialities")]
    #[ORM\JoinColumn(nullable: false)]
    private $speciality;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: "userSpecialities")]
    #[ORM\JoinColumn(nullable: false)]
    private User $user;

    #[ORM\Column(type: "date")]
    private $dateStart;

    #[ORM\Column(type: "date", nullable: true)]
    private $dateEnd;

    public function __construct()
    {
        $this->id = Uuid::v4();
    }

    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function getSpeciality(): ?speciality
    {
        return $this->speciality;
    }

    public function setSpeciality(?speciality $speciality): self
    {
        $this->speciality = $speciality;

        return $this;
    }

    public function getDateStart(): ?\DateTimeInterface
    {
        return $this->dateStart;
    }

    public function setDateStart(\DateTimeInterface $dateStart): self
    {
        $this->dateStart = $dateStart;

        return $this;
    }

    public function getDateEnd(): ?\DateTimeInterface
    {
        return $this->dateEnd;
    }

    public function setDateEnd(?\DateTimeInterface $dateEnd): self
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;
        return $this;
    }
}

<?php

namespace GlobalEmergency\Apuntate\Entity;

use GlobalEmergency\Apuntate\Repository\RequirementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: RequirementRepository::class)]
class Requirement
{
    #[ORM\Id]
    #[ORM\Column(type: "uuid", unique: true)]
    private $id;

    #[ORM\Column(type: "string", length: 255)]
    private $name;

    #[ORM\ManyToMany(targetEntity: Component::class, mappedBy: "requirements")]
    private $components;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: "requirements")]
    private $users;

    public function __construct()
    {
        $this->id = Uuid::v4();
        $this->components = new ArrayCollection();
        $this->users = new ArrayCollection();
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
     * @return Collection|Component[]
     */
    public function getComponents(): Collection
    {
        return $this->components;
    }

    public function addComponent(Component $component): self
    {
        if (!$this->components->contains($component)) {
            $this->components[] = $component;
            $component->addRequirement($this);
        }

        return $this;
    }

    public function removeComponent(Component $component): self
    {
        if ($this->components->removeElement($component)) {
            $component->removeRequirement($this);
        }

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->addRequirement($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            $user->removeRequirement($this);
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}

<?php

namespace GlobalEmergency\Apuntate\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;

/**
 * Adds created at and updated at timestamps to entities.
 * Entities using this must have HasLifecycleCallbacks annotation.
 *
 * @ORM\HasLifecycleCallbacks
 */
trait Timestampable
{
    #[ORM\Column]
    private \DateTime $createdAt;

    #[ORM\Column]
    private \DateTime $updatedAt;

    #[ORM\PrePersist]
    public function onPrePersist()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }

    /**
     * Gets triggered every time on update.
     *
     * @ORM\PreUpdate
     */
    #[ORM\PreUpdate]
    public function onPreUpdate()
    {
        $this->updatedAt = new \DateTime();
    }

    /**
     * Set createdAt.
     *
     * @param \DateTime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt.
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt.
     *
     * @param \DateTime $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt.
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}

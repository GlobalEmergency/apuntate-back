<?php

namespace GlobalEmergency\Apuntate\Type;

class ServiceStatusType extends EnumType
{
    /**
     * Service in elaboration.
     */
    public const DRAFT = 'draft';

    /**
     * Service requested.
     */
    public const REQUESTED = 'requested';

    /**
     * Service accepted and is being sended to volunteers.
     */
    public const ACCEPTED = 'accepted';

    /**
     * Service rejected by agrupation.
     */
    public const REJECTED = 'rejected';

    /**
     * Service with volunteers confirmed.
     */
    public const CONFIRMED = 'confirmed';

    /**
     * Service cancelled by requester.
     */
    public const CANCELLED = 'cancelled';

    /**
     * Service pending to be analyzed.
     */
    public const DEBRIEFING = 'debriefing';

    /**
     * Finished service.
     */
    public const FINISHED = 'finished';

    protected string $name = 'serviceStatus';

    public static function getValues()
    {
        $refl = new \ReflectionClass(__CLASS__);

        return $refl->getConstants();
    }
}

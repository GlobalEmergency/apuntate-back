<?php

namespace GlobalEmergency\Apuntate\Type;

class ServiceStatusType extends EnumType
{
    /**
     * Service in elaboration
     */
    const DRAFT = 'draft';

    /**
     * Service requested
     */
    const REQUESTED = 'requested';

    /**
     * Service accepted and is being sended to volunteers
     */
    const ACCEPTED = 'accepted';

    /**
     * Service rejected by agrupation
     */
    const REJECTED = 'rejected';

    /**
     * Service with volunteers confirmed
     */
    const CONFIRMED = 'confirmed';

    /**
     * Service cancelled by requester
     */
    const CANCELLED = 'cancelled';

    /**
     * Service pending to be analyzed
     */
    const DEBRIEFING = 'debriefing';

    /**
     * Finished service
     */
    const FINISHED = 'finished';

    protected string $name = 'serviceStatus';

    public static function getValues(){
        $refl = new \ReflectionClass(__CLASS__);
        return $refl->getConstants();
    }

}

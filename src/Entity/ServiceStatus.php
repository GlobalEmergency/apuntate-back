<?php

declare(strict_types=1);

namespace GlobalEmergency\Apuntate\Entity;

enum ServiceStatus: string
{
    case DRAFT = 'draft';
    case REQUESTED = 'requested';
    case ACCEPTED = 'accepted';
    case REJECTED = 'rejected';
    case CONFIRMED = 'confirmed';
    case CANCELLED = 'cancelled';
    case DEBRIEFING = 'debriefing';
    case FINISHED = 'finished';
}

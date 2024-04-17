<?php

declare(strict_types=1);

namespace GlobalEmergency\Apuntate\Services;

use GlobalEmergency\Apuntate\Entity\Service;

final class CalendarTransform
{
    public static function transformServices(array $services): array
    {
        $events = [];
        foreach ($services as $service) {
            $events[] = self::transformService($service);
        }
        return $events;
    }

    public static function transformService(Service $service): array
    {
        return [
            'id' => (string)$service->getId(),
            'title'=>$service->getName(),
            'start' => $service->getDateStart()->toIso8601String(),
            'end' => $service->getDateEnd()->toIso8601String(),
            'allDay' => false,
        ];
    }
}

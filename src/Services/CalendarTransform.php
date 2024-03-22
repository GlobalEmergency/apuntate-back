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
            'startTime' => $service->getDateStart()->format('D M d Y H:i:s O'),
            'endTime' => $service->getDateEnd()->format('D M d Y H:i:s O'),
            'allDay' => false,
        ];
    }
}

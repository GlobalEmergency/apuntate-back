<?php
declare(strict_types=1);

namespace App\Services;

use App\Entity\Service;

final class CalendarTransform
{
    static function transformServices(array $services): array
    {
        $events = [];
        foreach ($services as $service) {
            $events[] = self::transformService($service);
        }
        return $events;
    }

    static function transformService(Service $service):array
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

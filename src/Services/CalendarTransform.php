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
            'id' => $service->getId(),
            'title'=>$service->getName(),
            'startTime' => $service->getDate()->format('D M d Y H:i:s O'),
            'endTime' => $service->getDate()->addHours(rand(4,20))->format('D M d Y H:i:s O'),
            'allDay' => false,
        ];
    }
}

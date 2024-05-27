<?php

declare(strict_types=1);

namespace GlobalEmergency\Apuntate\Tests\Mothers;

use Carbon\Carbon;
use GlobalEmergency\Apuntate\Entity\Service;

final class ServiceMother
{
    public static function create(): Service
    {
        $dateOfEvent = Carbon::now()->addDays(rand(1, 10));
        $service = new Service();
        $service->setName('Service 1');
        $service->setDescription('Description 1');
        //        $service->setDatePlace(Carbon::)

        return $service;
    }
}

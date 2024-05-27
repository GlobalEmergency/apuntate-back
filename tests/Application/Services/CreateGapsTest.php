<?php

declare(strict_types=1);

namespace GlobalEmergency\Apuntate\Tests\Application\Services;

use GlobalEmergency\Apuntate\Entity\Service;
use GlobalEmergency\Apuntate\Repository\ServiceRepository;
use GlobalEmergency\Apuntate\Repository\UnitRepository;
use PHPUnit\Framework\TestCase;

class CreateGapsTest extends TestCase
{
    private CreateGaps $createGaps;
    private UnitRepository $unitRepository;
    private ServiceRepository $serviceRepository;

    public function setUp(): void
    {
        $this->unitRepository = $this->createMock(UnitRepository::class);
        $this->serviceRepository = $this->createMock(ServiceRepository::class);

        $this->createGaps = new CreateGaps($this->unitRepository, $this->serviceRepository);
    }

    public function testCreate()
    {
        $service = new Service();

        $holes = ['unitId' => 3];
        $this->createGaps->create($service, $holes);
    }
}

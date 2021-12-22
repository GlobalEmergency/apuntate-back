<?php

declare(strict_types=1);

namespace App\Application\Services;

use App\Entity\Gap;
use App\Entity\Service;
use App\Repository\ServiceRepository;
use App\Repository\UnitComponentRepository;
use App\Repository\UnitRepository;

final class CreateGaps
{
    private UnitRepository $unitRepository;

    private ServiceRepository $serviceRepository;

    private UnitComponentRepository $unitComponentRepository;

    public function __construct(UnitRepository $unitRepository, ServiceRepository $serviceRepository, UnitComponentRepository $unitComponentRepository)
    {
        $this->unitRepository = $unitRepository;
        $this->serviceRepository = $serviceRepository;
        $this->unitComponentRepository = $unitComponentRepository;
    }

    public function create(Service $service, array $holes): Service
    {
        foreach ($holes as $unitId => $amount) {
            $unit = $this->unitRepository->find($unitId);
            if (is_null($unit)) {
                continue;
            }
            $nexted = [];
            $holesCreated = 0;
            //First create one gap for each component, and store unitcomponents with more that one hole.
            foreach ($unit->getUnitComponents() as $unitComponent) {
                $gap = new Gap();
                $gap->setService($service);
                $gap->setUnitComponent($unitComponent);
                $service->addGap($gap);
                echo '1 Add gap '.$unitComponent.'|'.$gap->getUnitComponent().'<br />';
                ++$holesCreated;
                if ($unitComponent->getQuantity() > 1) {
                    $nexted[] = [
                        $unitComponent,
                        $unitComponent->getQuantity() - 1,
                    ];
                }
            }
            while ($amount > $holesCreated) {
                echo "While $holesCreated <br />";
                //Then create the gaps necesary to fill the holes.
                foreach ($nexted as $key => [$unitComponent, $rest]) {
                    echo "Foreach $holesCreated | $rest<br />";
                    if ($holesCreated >= $amount) {
                        break;
                    }
                    $gap = new Gap();
                    $gap->setService($service);
                    $gap->setUnitComponent($unitComponent);
                    $service->addGap($gap);
                    echo '2 Add gap '.$unitComponent.'|'.$gap->getUnitComponent().'<br />';

                    ++$holesCreated;
                    if ($rest > 1) {
                        $nexted[$key] = $rest - 1;
                    } else {
                        unset($nexted[$key]);
                        break;
                    }
                }
            }
        }
        $this->serviceRepository->save($service);

        return $service;
    }
}

<?php

declare(strict_types=1);

namespace GlobalEmergency\Apuntate\Application\Services;

use GlobalEmergency\Apuntate\Entity\Gap;
use GlobalEmergency\Apuntate\Entity\Service;
use GlobalEmergency\Apuntate\Repository\ServiceRepository;
use GlobalEmergency\Apuntate\Repository\UnitRepository;

final class CreateGaps
{
    private UnitRepository $unitRepository;

    private ServiceRepository $serviceRepository;

    public function __construct(UnitRepository $unitRepository, ServiceRepository $serviceRepository)
    {
        $this->unitRepository = $unitRepository;
        $this->serviceRepository = $serviceRepository;
    }

    public function create(Service $service, array $holes): Service
    {
        foreach ($holes as $unitId => $amount) {
            $unit = $this->unitRepository->find($unitId);
            if (is_null($unit)) {
                continue;
            }
            echo 'Unit '.$unit.' -> '.$amount.'<br />';
            $nexted = [];
            $holesCreated = 0;
            // First create one gap for each component, and store unitcomponents with more that one hole.
            foreach ($unit->getUnitComponents() as $unitComponent) {
                $gap = new Gap();
                $gap->setService($service);
                $gap->setUnitComponent($unitComponent);
                $service->addGap($gap);
                ++$holesCreated;
                echo $holesCreated.' Add gap '.$gap->getUnitComponent().'<br />';

                if ($unitComponent->getQuantity() > 1) {
                    $nexted[] = [
                        $unitComponent,
                        $unitComponent->getQuantity() - 1,
                    ];
                }
            }
            while ($amount > $holesCreated) {
                echo "While $holesCreated | $amount <br />";
                // Then create the gaps necessary to fill the holes.
                foreach ($nexted as $key => $value) {
                    $unitComponent = $value[0];
                    $rest = $value[1];
                    echo "Foreach $holesCreated | $rest | $unitComponent<br />";
                    if ($holesCreated >= $amount) {
                        break;
                    }
                    $gap = new Gap();
                    $gap->setService($service);
                    $gap->setUnitComponent($unitComponent);
                    $service->addGap($gap);

                    ++$holesCreated;
                    echo $holesCreated.' Add gap '.$gap->getUnitComponent().'->'.$rest.' <br />';

                    if ($rest > 1) {
                        $nexted[$key][1] = $rest - 1;
                    } else {
                        unset($nexted[$key]);
                        break;
                    }
                }
            }
        }
        //        $this->serviceRepository->save($service);

        return $service;
    }
}

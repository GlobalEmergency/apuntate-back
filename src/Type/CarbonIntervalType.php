<?php

declare(strict_types=1);

namespace GlobalEmergency\Apuntate\Type;

use Carbon\CarbonInterval;
use Carbon\Doctrine\CarbonDoctrineType;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\DateIntervalType;
use PHPUnit\Exception;

final class CarbonIntervalType extends DateIntervalType implements CarbonDoctrineType
{
    public function getName()
    {
        return 'carbon_interval';
    }
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if ($value === null || $value instanceof CarbonInterval) {
            return $value;
        }

        $negative = false;

        if (isset($value[0]) && ($value[0] === '+' || $value[0] === '-')) {
            $negative = $value[0] === '-';
            $value    = substr($value, 1);
        }
        if ($value === "") {
            return new CarbonInterval(0, 0, 0, 0, 1);
        }

        try {
            $interval = new CarbonInterval($value);
        } catch (\Exception $exception) {
            try {
                $interval = CarbonInterval::createFromFormat("H:i:s", $value);
            } catch (\Exception $ex) {
                throw ConversionException::conversionFailedFormat($value, $this->getName(), self::FORMAT, $exception);
            }
        }
        if ($negative) {
            $interval->invert = 1;
        }
        return $interval;
    }
}

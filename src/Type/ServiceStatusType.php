<?php

namespace GlobalEmergency\Apuntate\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use GlobalEmergency\Apuntate\Entity\ServiceStatus;

class ServiceStatusType extends Type
{
    public const NAME = 'serviceStatus';

    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform): string
    {
        $values = implode(',', array_map(function (ServiceStatus $case) { return "'".$case->name."'"; }, ServiceStatus::cases()));

        return 'ENUM('.$values.')';
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): mixed
    {
        return ServiceStatus::from($value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): mixed
    {
        if ($value instanceof ServiceStatus) {
            return $value->name;
        }

        throw new \InvalidArgumentException('Invalid ServiceStatus');
    }

    public function getName(): string
    {
        return self::NAME;
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }
}

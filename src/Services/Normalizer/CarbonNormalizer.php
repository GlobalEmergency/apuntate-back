<?php

declare(strict_types=1);

namespace GlobalEmergency\Apuntate\Services\Normalizer;

use Carbon\Carbon;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class CarbonNormalizer implements NormalizerInterface
{
    public function supportsNormalization($data, $format = null, array $context = []): bool
    {
        return $data instanceof Carbon;
    }

    public function getSupportedTypes(?string $format): array
    {
        return [
            Carbon::class,
        ];
    }

    public function normalize(mixed $object, ?string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
    {
        return $object->toW3cString();
    }
}

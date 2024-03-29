<?php

declare(strict_types=1);

namespace GlobalEmergency\Apuntate\Services\Normalizer;

use Carbon\Carbon;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class CarbonNormalizer implements NormalizerInterface
{
    /**
     * {@inheritdoc}
     */
    public function normalize($object, $format = null, array $context = [])
    {
        return $object->toW3cString();
    }

    /**
     * {@inheritdoc}
     */
    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof Carbon;
    }
}

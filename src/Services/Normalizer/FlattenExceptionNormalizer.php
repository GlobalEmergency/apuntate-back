<?php
declare(strict_types=1);


namespace GlobalEmergency\Apuntate\Services\Normalizer;


use Symfony\Component\ErrorHandler\Exception\FlattenException;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class FlattenExceptionNormalizer implements NormalizerInterface
{
    public function normalize($object, string $format = null, array $context = []): float|array|\ArrayObject|bool|int|string|null
    {
        return [
            'status' => $object->getStatusCode(),
            'message' => $object->getMessage(),
            'class' => $object->getClass(),
            'file' => $object->getFile(),
            'line' => $object->getLine(),
        ];
    }

    public function supportsNormalization($data, string $format = null, array $context = []): bool
    {
        return $data instanceof FlattenException;
    }

    public function getSupportedTypes(?string $format): array
    {
        return [
            FlattenException::class,
        ];
    }
}

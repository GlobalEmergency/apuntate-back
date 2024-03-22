<?php

declare(strict_types=1);

namespace GlobalEmergency\Apuntate\Services;

use GlobalEmergency\Apuntate\Services\Normalizer\CarbonNormalizer;
use Carbon\Carbon;
use Doctrine\Common\Annotations\AnnotationReader;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\Normalizer\AbstractObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

final class JsonResponse extends \Symfony\Component\HttpFoundation\JsonResponse
{
    public function __construct($data, int $status = 200, array $headers = [], bool $json = false)
    {
        $classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));
        $normalizer = new ObjectNormalizer($classMetadataFactory);

        $dateTimeNormalizer = new CarbonNormalizer();
        $serializer = new Serializer([$dateTimeNormalizer,$normalizer]);

        $result = $serializer->normalize($data, 'json', [ObjectNormalizer::ENABLE_MAX_DEPTH => true,ObjectNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object) {
            return $object->getId();
        }]);

        parent::__construct($result, $status, $headers, $json);
    }
}

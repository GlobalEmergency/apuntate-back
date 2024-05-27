<?php

declare(strict_types=1);

namespace GlobalEmergency\Apuntate\Shared\Infrastructure\Rest;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/health", name="health_")
 */
final class HealthController
{
    /**
     * @Route("/" name="general")
     */
    public function health(): Response
    {
        return new Response('OK');
    }
}

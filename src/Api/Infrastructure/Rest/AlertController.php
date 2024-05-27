<?php

declare(strict_types=1);

namespace GlobalEmergency\Apuntate\Api\Infrastructure\Rest;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/alerts')]
final class AlertController extends AbstractController
{
    #[Route('', methods: ['GET'])]
    public function get(): Response
    {
        return new JsonResponse([
            ['id' => 1, 'title' => 'Alert 1', 'resume' => 'Description 1', 'show' => true],
            ['id' => 2, 'title' => 'Alert 2', 'resume' => 'Description 2', 'show' => false],
            ['id' => 3, 'title' => 'Alert 3', 'resume' => 'Description 3', 'show' => false],
        ]);
    }

    #[Route('/{alert}', methods: ['POST'])]
    public function update(Request $request, string $alert): Response
    {
        return new Response(null, 200);
    }
}

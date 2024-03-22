<?php

declare(strict_types=1);

namespace GlobalEmergency\Apuntate\Controller\API;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/profile')]
final class ProfileController extends AbstractController
{
    #[Route('/', methods: ['GET'])]
    public function getProfile(): Response
    {
        return new JsonResponse($this->getUser());
    }

    #[Route('/alerts', methods: ['GET'])]
    public function getAlerts(): Response
    {
        return new JsonResponse([
            ['id' => 1, 'title' => 'Alert 1', 'resume' => 'Description 1'],
            ['id' => 2, 'title' => 'Alert 2', 'resume' => 'Description 2'],
            ['id' => 3, 'title' => 'Alert 3', 'resume' => 'Description 3'],
        ]);
    }
}

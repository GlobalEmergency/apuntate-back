<?php
declare(strict_types=1);

namespace App\Controller\API;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
/**
 * @Route("/api/profile")
 */
final class ProfileController extends AbstractController
{

    /**
     * @Route ("/", methods={"GET"})
     */
    public function getProfile(): Response{
        return new JsonResponse($this->getUser());
    }
}

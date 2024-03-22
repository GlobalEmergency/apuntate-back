<?php

declare(strict_types=1);

namespace GlobalEmergency\Apuntate\Api\Infrastructure\Rest;

use GlobalEmergency\Apuntate\Api\Infrastructure\Rest\JsonResponse;
use Carbon\Carbon;
use GlobalEmergency\Apuntate\Entity\Service;
use GlobalEmergency\Apuntate\Repository\ServiceRepository;
use GlobalEmergency\Apuntate\Services\CalendarTransform;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api/services', name: 'api_services_')]
final class ServicesController extends AbstractController
{
    #[Route('/calendar', name: 'calendar', methods: ['GET'])]
    public function getCalendar(Request $request, ServiceRepository $serviceRepository)
    {
        $dateStart = Carbon::createFromFormat('d-m-Y', $request->get('s'))->startOfDay();
        $dateEnd = Carbon::createFromFormat('d-m-Y', $request->get('e'))->endOfDay();
        $services = $serviceRepository->findBetweenDates($dateStart, $dateEnd);

        return new JsonResponse(CalendarTransform::transformServices($services));
    }

    #[Route('/{service}', name: 'get', methods: ['GET'])]
    public function getService(Request $request, ServiceRepository $serviceRepository, string $service, SerializerInterface $serializer)
    {
        $service = $serviceRepository->find($service);

        return new JsonResponse($service);
    }
//    {
//        $service = $serviceRepository->find($service);
//        $response = new Response(
//            $serializer->serialize($service, 'json'),
//            Response::HTTP_OK,
//            ['Content-type' => 'application/json']
//        );
//
//        return $response:
//    }
}

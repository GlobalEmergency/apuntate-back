<?php

declare(strict_types=1);

namespace GlobalEmergency\Apuntate\Api\Infrastructure\Rest;

use Carbon\Carbon;
use GlobalEmergency\Apuntate\Entity\Service;
use GlobalEmergency\Apuntate\Repository\ServiceRepository;
use GlobalEmergency\Apuntate\Services\CalendarTransform;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Uid\Uuid;

#[Route('/api/services', name: 'api_services_')]
final class ServicesController extends AbstractController
{
    #[Route('/nexts', name: 'nexts', methods: ['GET'])]
    public function nexts(Request $request, ServiceRepository $serviceRepository, SerializerInterface $serializer)
    {
        $services = $serviceRepository->findNexts();

        return new JsonResponse($serializer->serialize($services, 'json'), 200, [], true);
    }

    #[Route('/calendar', name: 'calendar', methods: ['GET'])]
    public function getCalendar(Request $request, ServiceRepository $serviceRepository)
    {
        $dateStart = Carbon::parseFromLocale($request->get('s', Carbon::now()->startOfMonth()->format('d-m-Y')))->startOfDay();
        $dateEnd = Carbon::parseFromLocale($request->get('e', Carbon::now()->endOfMonth()->format('d-m-Y')))->endOfDay();
        $services = $serviceRepository->findBetweenDates($dateStart, $dateEnd);

        return new JsonResponse(CalendarTransform::transformServices($services));
    }

    #[Route('', name: 'post', methods: ['POST'])]
    public function newService(Request $request, ServiceRepository $serviceRepository, SerializerInterface $serializer)
    {
        $service = $serializer->deserialize($request->getContent(), Service::class, 'json');
        $serviceRepository->save($service);

        return new JsonResponse(null, 201);
    }

    #[Route('/{service}', name: 'get', methods: ['GET'])]
    public function getService(Request $request, ServiceRepository $serviceRepository, Uuid $service, SerializerInterface $serializer)
    {
        $service = $serviceRepository->find($service);

        return new JsonResponse($serializer->serialize($service, 'json'), 200, [], true);
    }
}

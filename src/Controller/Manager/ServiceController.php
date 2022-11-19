<?php

declare(strict_types=1);

namespace GlobalEmergency\Apuntate\Controller\Manager;

use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use GlobalEmergency\Apuntate\Application\Services\CreateGaps;
use GlobalEmergency\Apuntate\Entity\Service;
use GlobalEmergency\Apuntate\Repository\GapRepository;
use GlobalEmergency\Apuntate\Repository\ServiceRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @Route("/manager/service", name="manager_service_")
 */
final class ServiceController extends AbstractDashboardController
{
    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        $services = $this->getDoctrine()->getRepository(Service::class)->findNexts();

        return $this->render('manager/service/index.html.twig', [
            'services' => $services,
        ]);
    }

    /**
     * @param GapRepository $gapRepository
     *
     * @Route("/{serviceId}", name="detail")
     */
    public function gaps(Request $request, CreateGaps $createGaps, ServiceRepository $serviceRepository, string $serviceId): Response
    {
        $service = $serviceRepository->find($serviceId);
        if ('POST' == $request->getMethod() && count($request->request->all()) > 0) {
            $createGaps->create($service, $request->request->all());
        }

        return $this->render('manager/service/details.html.twig', [
            'service' => $service,
        ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()->setTitle('Apuntate Manager');
    }

    public function configureAssets(): Assets
    {
        // TODO: Implement configureAssets() method.
        return parent::configureAssets();
    }

    public function configureMenuItems(): iterable
    {
        // TODO: Implement configureMenuItems() method.
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Service', 'fas fa-list', Service::class);
        yield MenuItem::linkToRoute('Services', 'fas fa-list', 'manager_service_index');
    }

    public function configureUserMenu(UserInterface $user): UserMenu
    {
        // TODO: Implement configureUserMenu() method.
        return parent::configureUserMenu($user);
    }

//    public function configureCrud(): Crud
//    {
//        // TODO: Implement configureCrud() method.
//    }
//
//    public function configureActions(): Actions
//    {
//        // TODO: Implement configureActions() method.
//    }
//
//    public function configureFilters(): Filters
//    {
//        // TODO: Implement configureFilters() method.
//    }
}

<?php

namespace GlobalEmergency\Apuntate\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use GlobalEmergency\Apuntate\Controller\API\ServicesController;
use GlobalEmergency\Apuntate\Entity\Component;
use GlobalEmergency\Apuntate\Entity\Entity;
use GlobalEmergency\Apuntate\Entity\Gap;
use GlobalEmergency\Apuntate\Entity\Requirement;
use GlobalEmergency\Apuntate\Entity\Service;
use GlobalEmergency\Apuntate\Entity\Speciality;
use GlobalEmergency\Apuntate\Entity\Unit;
use GlobalEmergency\Apuntate\Entity\UnitComponent;
use GlobalEmergency\Apuntate\Entity\User;
use GlobalEmergency\Apuntate\Entity\UserSpeciality;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin')]
    public function index(): Response
    {
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(ServiceCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Apuntate');
    }

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::linktoDashboard('Dashboard', 'fa fa-home'),
            MenuItem::section('Entities'),
            MenuItem::linkToCrud('Service', 'fas fa-list', Service::class),
            MenuItem::linkToCrud('GAP', 'fas fa-list', Gap::class),
            MenuItem::linkToCrud('Speciality', 'fas fa-list', Speciality::class),
            MenuItem::linkToCrud('Unit', 'fas fa-list', Unit::class),
            MenuItem::linkToCrud('Unit Component', 'fas fa-list', UnitComponent::class),
            MenuItem::linkToCrud('User', 'fas fa-list', User::class),
            MenuItem::linkToCrud('User Speciality', 'fas fa-list', UserSpeciality::class),
            MenuItem::linkToCrud('Component', 'fas fa-list', Component::class),
            MenuItem::linkToCrud('Requirement', 'fas fa-list', Requirement::class),
        ];
    }
}

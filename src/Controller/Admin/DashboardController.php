<?php

namespace App\Controller\Admin;

use App\Entity\Component;
use App\Entity\Entity;
use App\Entity\Gap;
use App\Entity\Requirement;
use App\Entity\Service;
use App\Entity\Speciality;
use App\Entity\Unit;
use App\Entity\UnitComponent;
use App\Entity\User;
use App\Entity\UserSpeciality;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Apuntate');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Service', 'fas fa-list', Service::class);
        yield MenuItem::linkToCrud('GAP', 'fas fa-list', Gap::class);

        yield MenuItem::linkToCrud('Speciality', 'fas fa-list', Speciality::class);
        yield MenuItem::linkToCrud('Unit', 'fas fa-list', Unit::class);
        yield MenuItem::linkToCrud('Unit Component', 'fas fa-list', UnitComponent::class);
        yield MenuItem::linkToCrud('User', 'fas fa-list', User::class);
        yield MenuItem::linkToCrud('User Speciality', 'fas fa-list', UserSpeciality::class);

        yield MenuItem::linkToCrud('Component', 'fas fa-list', Component::class);
        yield MenuItem::linkToCrud('Requirement', 'fas fa-list', Requirement::class);
    }
}

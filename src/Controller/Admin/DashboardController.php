<?php

namespace App\Controller\Admin;

use App\Entity\Bet;
use App\Entity\Matches;
use App\Entity\Team;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(UserCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Eurobet');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-user', User::class);
        yield MenuItem::section();
        yield MenuItem::linkToCrud('Equipes', 'fas fa-users', Team::class);
        yield MenuItem::linkToCrud('Matchs', 'fas fa-football', Matches::class);
        yield MenuItem::linkToCrud('Paris', 'fas fa-comment-dollar', Bet::class);
        yield MenuItem::section();
        yield MenuItem::linkToUrl('Home', 'fa fa-home', $this->generateUrl('app_home'));

    }
}

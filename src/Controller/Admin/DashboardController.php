<?php

namespace App\Controller\Admin;


use App\Entity\Agent;
use App\Entity\Citoyen;
use App\Entity\Amende;
use App\Entity\Armes;
use App\Entity\PeinePrison;
use App\Entity\Plainte;
use App\Entity\Rapport;
use App\Entity\Vehicule;
use App\Entity\Vol;
use App\Entity\VolVehicule;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class DashboardController extends AbstractDashboardController
{
    
    #[Route('/', name: 'admin')]
    #[IsGranted('IS_AUTHENTICATED')]
    public function index(): Response
    {

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        //$adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
         //return $this->redirect($adminUrlGenerator->setController(AgentCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
         return $this->render('stats/index.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->renderContentMaximized()
            ->setTitle('LSPD Panel');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Accueil', 'fa fa-home');
        yield MenuItem::section('Citoyens')->setPermission('ROLE_LIEUTENANT');
        yield MenuItem::linkToCrud('Agents', 'fa-solid fa-shield-halved', Agent::class)->setPermission('ROLE_LIEUTENANT');
        yield MenuItem::linkToCrud('Citoyens', 'fa-solid fa-user', Citoyen::class)->setPermission('ROLE_LIEUTENANT');

        yield MenuItem::section('Véhicules')->setPermission('ROLE_ADJOINT');
        yield MenuItem::linkToCrud('Véhicules', 'fa-solid fa-car', Vehicule::class)->setPermission('ROLE_ADJOINT');
        yield MenuItem::linkToCrud('Vols de Vehicule', 'fa-solid fa-car-burst', VolVehicule::class)->setPermission('ROLE_ADJOINT');

        yield MenuItem::section('Armes')->setPermission('ROLE_ADJOINT');
        yield MenuItem::linkToCrud('Armes', 'fa-solid fa-person-rifle', Armes::class)->setPermission('ROLE_ADJOINT');

        yield MenuItem::section('Sanctions')->setPermission('ROLE_ADJOINT');
        yield MenuItem::linkToCrud('Amendes', 'fa-solid fa-receipt', Amende::class)->setPermission('ROLE_ADJOINT');
        yield MenuItem::linkToCrud('Peines de prison', 'fa-solid fa-link', PeinePrison::class)->setPermission('ROLE_ADJOINT');

        yield MenuItem::section('recherche')->setPermission('ROLE_ADJOINT');
        yield MenuItem::linkToCrud('Rapports', 'fa-solid fa-file-pen', Rapport::class)->setPermission('ROLE_ADJOINT');
        yield MenuItem::linkToCrud('Plaintes', 'fa-solid fa-exclamation', Plainte::class)->setPermission('ROLE_ADJOINT');
        yield MenuItem::linkToCrud('Vols', 'fa-solid fa-sack-dollar', Vol::class)->setPermission('ROLE_ADJOINT');

        yield MenuItem::section('plus');
        yield MenuItem::linkToRoute('Editer', 'fa-solid fa-user-pen','app_edit');
        yield MenuItem::linkToLogout('Déconnexion', 'fa-solid fa-right-from-bracket');
    }
}

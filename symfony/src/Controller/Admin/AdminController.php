<?php

namespace App\Controller\Admin;

use App\Entity\Contact;
use App\Entity\Order;
use App\Entity\Product;
use App\Entity\Reduce;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractDashboardController
{
    public function __construct(private AdminUrlGenerator $adminUrlGenerator)
    {
    }
    #[Route('/admin', name: 'admin')]
    #[IsGranted('ROLE_ADMIN')]
    public function index(): Response
    {

        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Laxar - Administration')
            ->renderContentMaximized();
    }

    public function configureMenuItems(): iterable
    {
        // Permet de choisir le menu 
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-user', User::class);
        yield MenuItem::linkToCrud('Contacts', 'fa-solid fa-message', Contact::class);
        yield MenuItem::linkToCrud('Produits', 'fa-solid fa-clock', Product::class);
        yield MenuItem::linkToCrud('Reductions', 'fa-solid fa-tag ', Reduce::class);
        yield MenuItem::linkToCrud('Commandes', 'fa-solid fa-cart-shopping', Order::class);
    }
}

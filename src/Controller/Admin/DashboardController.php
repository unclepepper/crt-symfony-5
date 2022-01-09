<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Product as ProductEntity;
use App\Entity\Basket as BasketEntity;
use App\Entity\User as UserEntity;
use App\Entity\Order as OrderEntity;

use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // return parent::index();
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);

        return $this->redirect($adminUrlGenerator->setController(ProductCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('AdminPanel');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoRoute('Back to Home', 'fas fa-home', 'index');
        // yield MenuItem::linkToDashboard('Dashboard', 'fa fa-list');
        yield MenuItem::linkToCrud('Product', 'fas fa-pizza-slice', ProductEntity::class);
        yield MenuItem::linkToCrud('Basket', 'fas fa-shopping-basket', BasketEntity::class);
        yield MenuItem::linkToCrud('User', 'fas fa-user', UserEntity::class);
        yield MenuItem::linkToCrud('Order', 'fas fa-list', OrderEntity::class);


    }
}

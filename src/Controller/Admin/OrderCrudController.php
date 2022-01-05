<?php

namespace App\Controller\Admin;

use App\Entity\Order;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;


class OrderCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Order::class;
    }

   
    public function configureFields(string $pageName): iterable
    {
        return [
          
            TextField::new('client_name'),
            TextField::new('client_phone'),
            AssociationField::new('basket'),
            



            
        ];
    }
    
}

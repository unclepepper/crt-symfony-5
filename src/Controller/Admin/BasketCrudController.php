<?php

namespace App\Controller\Admin;

use App\Entity\Basket;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class BasketCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Basket::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
           
            NumberField::new('price_one'),
            NumberField::new('quantity'),

            NumberField::new('price_total'),
           AssociationField::new('product_id'),

           
        ];
    }
    
}

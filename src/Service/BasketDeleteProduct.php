<?php
namespace App\Service;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\BasketRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Basket;
use App\Entity\Product;

class BasketDeleteProduct
{
    private BasketRepository $doctrine;
    private EntityManagerInterface $entityManager;

    public function __construct(BasketRepository $doctrine, EntityManagerInterface $entityManager)
    {
        $this->doctrine = $doctrine;
        $this->entityManager = $entityManager;
    }
    
    public function deleteBasket($id):void
    {
        $basket= $this->doctrine->findOneBy(['id' => $id]);

        $this->entityManager->remove($basket);
        $this->entityManager->flush();
    }
}

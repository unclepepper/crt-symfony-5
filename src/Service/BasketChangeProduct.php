<?php
namespace App\Service;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\BasketRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Basket;
use App\Entity\Product;

class BasketChangeProduct
{
    private BasketRepository $doctrine;
    private EntityManagerInterface $entityManager;

    public function __construct(BasketRepository $doctrine, EntityManagerInterface $entityManager)
    {
        $this->doctrine = $doctrine;
        $this->entityManager = $entityManager;
    }
    public function changeBasket(Request $request):void
    {
        if ($request->getMethod() == Request::METHOD_POST) {
            $quantity = $request->request->get('quantity');
            $product_id = $request->request->get('product_id');
            $price_product= $request->request->get('price_product');
                       
            $basket= $this->doctrine->findOneBy(['id' => $product_id]);
            $basket
                ->setQuantity($quantity)
                ->setPriceOne($price_product)
                ->setPriceTotal($price_product * $quantity);
        }
       
        $this->entityManager->flush();
    }
}

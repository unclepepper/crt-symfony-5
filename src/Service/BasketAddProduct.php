<?php
namespace App\Service;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Basket;
use App\Entity\Product;
use App\Service\BasketChangeProduct;


class BasketAddProduct
{ 
    public function addBasket(Request $request, EntityManagerInterface $entityManager, BasketRepository $doctrine):void
    {
        if ($request->getMethod() == Request::METHOD_POST) {
            $quantity = $request->request->get('quantity');
            $product_id = $request->request->get('product_id');
            $price_product= $request->request->get('price_product');
                       
            $basket= $doctrine->findOneBy(['id' => $product_id]);

            $basket
                ->setQuantity($quantity)
                ->setPriceOne($price_product)
                ->setPriceTotal($price_product * $quantity);
        }
       
        $entityManager->flush();
    }
}

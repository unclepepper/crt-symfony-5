<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\OrderRepository;
use App\Repository\BasketRepository;
use App\Repository\ProductRepository;
use App\Message\OrderMessage;
use App\Service\BasketChangeProduct;
use App\Service\BasketCreateProduct;
use App\Service\BasketDeleteProduct;
use Symfony\Component\Messenger\MessageBusInterface;

class ProductController extends AbstractController
{
       
         
    #[Route('/product/{id}', name: 'product', requirements: ['id' => '\d+'])]
    public function index(ProductRepository $doctrine, $id): Response
    {
        $product = $doctrine->findOneBy(['id' => $id]);
        return $this->render('product/index.html.twig', [
            'product' => $product,
        ]);
    }
    
    #[Route('/product/addBasket', name: 'addBasket')]
    public function addBasket(BasketCreateProduct $basketCreate, Request $request):Response
    {
        $product_id = $basketCreate->addBasket($request);
        return $this->redirectToRoute('product', ['id' => $product_id ]);
    }

    #[Route('/product/changeBasket', name: 'changeBasket')]
    public function changeBasket(BasketChangeProduct $basketChange, Request $request):Response
    {
        $basketChange->changeBasket($request);
        return $this->redirectToRoute('basket');
    }

    #[Route('/product/deleteBasket/{id}', name: 'deleteBasket', requirements: ['id' => '\d+'])]
    public function deleteBasket(BasketDeleteProduct $basketDelete, $id):Response
    {
        $basketDelete->deleteBasket($id);
        return $this->redirectToRoute('basket');
    }

    #[Route('/product/basket', name: 'basket')]
    public function basket(BasketRepository $doctrine): Response
    {
        $baskets = $doctrine->findAll();
        $title = 'Корзина';
        if (empty($baskets)) {
            $baskets = false;
            $title = 'Корзина пуста';
        }
        
        return $this->render(
            'basket/index.html.twig',
            [
              
                'baskets' => $baskets,
                'title' => $title,
               
            ]
        );
    }
    #[Route('/order/{id}/buy', name: 'buy')]
    public function show(int $id, OrderRepository $orderRepository, MessageBusInterface $bus): Response
    {
        $order = $orderRepository->find($id);
        $bus->dispatch(new orderMessage($order->getId(), []));
        return $this->redirectToRoute('order');
    }
}

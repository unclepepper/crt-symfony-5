<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Order;
use App\Form\OrderType;
use App\Repository\BasketRepository;
use Doctrine\ORM\EntityManagerInterface;

class OrderController extends AbstractController
{
    #[Route('/order', name: 'order')]
    public function index(BasketRepository $basketDoctrine, EntityManagerInterface $entityManager): Response
    {
        $baskets = $basketDoctrine->findAll();
            
        return $this->render('order/index.html.twig', [
           
            'baskets' => $baskets,
        ]);
    }
    #[Route('/order/add', name: 'orderAdd')]
    public function orderAdd(Request $request, BasketRepository $basketDoctrine, EntityManagerInterface $entityManager): Response
    {
        if ($request->getMethod() == Request::METHOD_POST) {
            $client_name = $request->request->get('client_name');
            $client_phone = $request->request->get('client_phone');
            
            $baskets = $basketDoctrine->findAll();
            $order = new Order();
            foreach ($baskets as $basket) {
                $order
                ->setClientName($client_name)
                ->setClientPhone($client_phone)
                ->addBasket($basket);
                $entityManager->persist($order);
                $entityManager->flush();
            }
        }
        return $this->redirectToRoute('order');
    }
    
}

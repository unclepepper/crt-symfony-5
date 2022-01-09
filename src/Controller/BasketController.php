<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\BasketRepository;

class BasketController extends AbstractController
{
    #[Route('/basket', name: 'basket')]
    
    public function index(BasketRepository $doctrine): Response
    {
        $baskets = $doctrine->findAll();
            
        if (empty($baskets)) {
            $baskets = false;
        }
  
        return $this->render('basket/index.html.twig', [
            'baskets' => $baskets,
            
        ]);
    }
}

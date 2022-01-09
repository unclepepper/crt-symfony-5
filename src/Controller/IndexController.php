<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(ProductRepository $prodDoctrine): Response
    {
        
        $product = $prodDoctrine->findAll();
        
        return $this->render('index/index.html.twig', [
            'product' => $product,            
        ]);
    }
    
    
}

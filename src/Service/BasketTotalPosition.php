<?php
namespace App\Service;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\BasketRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Basket;
use App\Entity\Product;

class BasketTotalPosition
{
    private $doctrine;

    public function __construct(BasketRepository $doctrine)
    {
        $this->doctrine = $doctrine;
    }
    public function totalBasket():?int
    {
        $totalPosition = 0;
        $baskets = $this->doctrine->findAll();
        if ($baskets) {
            foreach ($baskets as $basket) {
                $totalPosition = $totalPosition + 1;
            }
        }
        return $totalPosition;
    }
    public function totalPrice():?int
    {
        $totalPrice = 0;
        $baskets = $this->doctrine->findAll();
        if ($baskets) {
            foreach ($baskets as $basket) {
                $totalPrice += $basket->getPriceTotal();
            }
        }
        return $totalPrice;
    }
}

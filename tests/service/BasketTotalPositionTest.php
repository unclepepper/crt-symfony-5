<?php
namespace App\Service;

use App\Repository\BasketRepository;

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

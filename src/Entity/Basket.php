<?php

namespace App\Entity;

use App\Repository\BasketRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BasketRepository::class)
 */
class Basket
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    
    /**
     * @ORM\OneToMany(targetEntity=Product::class, mappedBy="basket")
     */
    private $product;

    /**
     * @ORM\Column(type="integer")
     */
    private ?int $quantity = null;

    /**
     * @ORM\Column(type="integer")
     */
    private ?int $price_one = null;

    /**
     * @ORM\Column(type="integer")
     */
    private ?int $price_total = null;

    /**
     * @ORM\ManyToOne(targetEntity=Product::class, inversedBy="baskets")
     */
    private  $product_id;

    /**
     * @ORM\ManyToOne(targetEntity=Order::class, inversedBy="basket_id")
     */
    private $order_id;

    /**
     * @ORM\ManyToMany(targetEntity=Order::class, mappedBy="basket")
     */
    private $orders;

    public function __construct()
    {
        $this->product = new ArrayCollection();
        $this->orders = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Product[]
     */
    public function getProduct(): Collection
    {
        return $this->product;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->product->contains($product)) {
            $this->product[] = $product;
            $product->setBasket($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->product->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getBasket() === $this) {
                $product->setBasket(null);
            }
        }

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getPriceOne(): ?int
    {
        return $this->price_one;
    }

    public function setPriceOne(int $price_one): self
    {
        $this->price_one = $price_one;

        return $this;
    }

    public function getPriceTotal(): ?int
    {
        return $this->price_total;
    }

    public function setPriceTotal(int $price_total): self
    {
        $this->price_total = $price_total;

        return $this;
    }

    public function getProductId(): ?Product
    {
        return $this->product_id;
    }

    public function setProductId(?Product $product_id): self
    {
        $this->product_id = $product_id;

        return $this;
    }

    public function getOrderId(): ?Order
    {
        return $this->order_id;
    }

    public function setOrderId(?Order $order_id): self
    {
        $this->order_id = $order_id;

        return $this;
    }
    public function __toString()
    {
        return $this->product_id->getName();
    }

    /**
     * @return Collection|Order[]
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function addOrder(Order $order): self
    {
        if (!$this->orders->contains($order)) {
            $this->orders[] = $order;
            $order->addBasket($this);
        }

        return $this;
    }

    public function removeOrder(Order $order): self
    {
        if ($this->orders->removeElement($order)) {
            $order->removeBasket($this);
        }

        return $this;
    }
    
}

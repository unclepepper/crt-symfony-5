<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrderRepository::class)
 * @ORM\Table(name="`order`")
 */
class Order
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $client_name = null;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $client_phone = null;

    /**
     * @ORM\OneToMany(targetEntity=Basket::class, mappedBy="order_id")
     */
    private $basket_id = [];

    /**
     * @ORM\ManyToMany(targetEntity=Basket::class, inversedBy="orders")
     */
    private $basket;

    public function __construct()
    {
        $this->basket_id = new ArrayCollection();
        $this->basket = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClientName(): ?string
    {
        return $this->client_name;
    }

    public function setClientName(string $client_name): self
    {
        $this->client_name = $client_name;

        return $this;
    }

    public function getClientPhone(): ?string
    {
        return $this->client_phone;
    }

    public function setClientPhone(string $client_phone): self
    {
        $this->client_phone = $client_phone;

        return $this;
    }

    /**
     * @return Collection|Basket[]
     */
    public function getBasketId(): Collection
    {
        return $this->basket_id;
    }

    public function addBasketId(Basket $basketId): self
    {
        if (!$this->basket_id->contains($basketId)) {
            $this->basket_id[] = $basketId;
            $basketId->setOrderId($this);
        }

        return $this;
    }

    public function removeBasketId(Basket $basketId): self
    {
        if ($this->basket_id->removeElement($basketId)) {
            // set the owning side to null (unless already changed)
            if ($basketId->getOrderId() === $this) {
                $basketId->setOrderId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Basket[]
     */
    public function getBasket(): Collection
    {
        return $this->basket;
    }

    public function addBasket(Basket $basket): self
    {
        if (!$this->basket->contains($basket)) {
            $this->basket[] = $basket;
        }

        return $this;
    }

    public function removeBasket(Basket $basket): self
    {
        $this->basket->removeElement($basket);

        return $this;
    }
}

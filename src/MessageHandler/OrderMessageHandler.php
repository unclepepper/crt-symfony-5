<?php
namespace App\MessageHandler;

use App\Repository\OrderRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use App\Message\OrderMessage;

class OrderMessageHandler implements MessageHandlerInterface
{
    private $em;
    private $orderRepository;

    public function __construct(EntityManagerInterface $entityManager, OrderRepository $orderRepository)
    {
        $this->em = $entityManager;
        $this->orderRepository = $orderRepository;
    }

    public function __invoke(OrderMessage $orderMessage)
    {
        $order = $this->orderRepository->find($orderMessage->getId());

        if (!$order) {
            return;
        }
        $order->setIsPay(true);
        $this->em->flush();
    }
}

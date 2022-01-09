<?php
namespace App\EventListener;

use Twig\Environment;
use Symfony\Component\HttpKernel\Event\ControllerEvent;


class TwigEventListener
{
    private $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function onKernelController(ControllerEvent $event)
    {
        $this->twig->addGlobal('time', new \DateTime('now'));
    }
}

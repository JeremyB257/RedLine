<?php

namespace App\EventSubscriber;

use App\Repository\ProductRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Twig\Environment;

class TwigEventSubscriber implements EventSubscriberInterface
{

    private $twig;
    private $productRepository;

    public function __construct(Environment $twig, ProductRepository $repository)
    {
        $this->twig = $twig;
        $this->productRepository = $repository;
    }

    public function onKernelController(ControllerEvent $event): void
    {
        $this->twig->addGlobal('productsGlobal', $this->productRepository->findAll());
        $this->twig->addGlobal('brandsGlobal', $this->productRepository->findDistinctBrand());
        $this->twig->addGlobal('materialsGlobal', $this->productRepository->findDistinctMaterial());
        $this->twig->addGlobal('caseDiametersGlobal', $this->productRepository->findDistinctCaseDiameter());
        $this->twig->addGlobal('movementsGlobal', $this->productRepository->findDistinctMovement());
        $this->twig->addGlobal('categoriesGlobal', $this->productRepository->findDistinctCategory());
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::CONTROLLER => 'onKernelController',
        ];
    }
}

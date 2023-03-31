<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    #[Route('/commandes', name: 'order.index')]
    public function index(): Response
    {
        return $this->render('user/order.html.twig', [
            'user' => $this->getUser()
        ]);
    }
}

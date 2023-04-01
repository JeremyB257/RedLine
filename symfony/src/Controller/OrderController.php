<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\OrderRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    #[Route('/{id}/commandes', name: 'order.index')]
    #[Security("is_granted('ROLE_USER') and user === currentUser")]
    public function index(User $currentUser, OrderRepository $orderRepo): Response
    {
        return $this->render('user/orderIndex.html.twig', [
            'user' => $currentUser,
            'orders' => $orderRepo->findBy(['user' => $currentUser], ['createdAt' => 'DESC'])
        ]);
    }


    #[Route('/{idUser}/commandes/{idOrder}', name: 'order.show')]
    #[Security("is_granted('ROLE_USER') and user === currentUser")]
    public function show(User $currentUser, OrderRepository $orderRepo): Response
    {

        return $this->render('user/orderShow.html.twig', [
            'user' => $currentUser,
            'orders' => $orderRepo->findBy(['user' => $currentUser], ['createdAt' => 'DESC'])
        ]);
    }
}

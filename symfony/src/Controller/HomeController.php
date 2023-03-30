<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home.index')]
    public function index(ProductRepository $productRepo): Response
    {


        return $this->render('index.html.twig', [
            
            'watch' => $productRepo->findOneBy([])
        ]);
    }
}

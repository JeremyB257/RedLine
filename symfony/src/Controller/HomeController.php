<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use App\Repository\ReviewRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home.index')]
    public function index(ProductRepository $productRepo, ReviewRepository $reviewRepo): Response
    {

        $brands = $productRepo->findDistinctBrand();
        $materials = $productRepo->findDistinctMaterial();
        $movements = $productRepo->findDistinctMovement();

        return $this->render('index.html.twig', [
            'watches' => $productRepo->findBy([], null, 5),
            'reviews' => $reviewRepo->findBy([], ['evaluation' => 'DESC'], 3),
        ]);
    }

    


    #[Route('/a-propos', name: 'app_about')]
    public function about(): Response
    {
        return $this->render('about.html.twig');
    }
}

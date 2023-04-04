<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/produits', name: 'app_product')]
    public function index(ProductRepository $repository, Request $request): Response
    {
        $filters['brand'] = $request->get('brand') ?? null;
        $filters['material'] = $request->get('material') ?? null;
        $filters['case_diameter'] = $request->get('case_diameter') ?? null;
        $filters['movement'] = $request->get('movement') ?? null;
        $filters['category'] = $request->get('category') ?? null;
        $searchTerm = $request->get('search') ?? null;

        $products = !empty($filters) ? $repository->findByManyFilters($filters) : $products = $repository->findAll();

        return $this->render('product/index.html.twig', [
            'brand_choice' => $filters['brand'],
            'material_choice' =>  $filters['material'],
            'case_diameter_choice' =>  $filters['case_diameter'],
            'movement_choice' => $filters['movement'],
            'category_choice' => $filters['category'],
        ]);
    }

    #[Route(path: '/{id}/produit', name: 'app_product_show')]
    public function show(int $id, ProductRepository $repository): Response
    {
        $product = $repository->find($id);

        if (!$product) {
            throw $this->createNotFoundException();
        };

        return $this->render('product/show.html.twig', [
            'product' => $product,
        ]);
    }
}

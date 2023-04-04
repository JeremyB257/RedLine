<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use App\Service\ProductService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/produits', name: 'app_product')]
    public function index(ProductService $repository, Request $request): Response
    {
        $filters['brand'] = $request->get('brand') ?? null;
        $filters['material'] = $request->get('material') ?? null;
        $filters['case_diameter'] = $request->get('case_diameter') ?? null;
        $filters['movement'] = $request->get('movement') ?? null;
        $filters['category'] = $request->get('category') ?? null;
        $order = $request->get('order_price') ?? false;
        $searchTerm = $request->get('search') ?? null;

        if ($filters['brand'] || $filters['material'] || $filters['case_diameter'] || $filters['movement'] || $filters['category'] || $order) {
            $products =  $repository->getPaginatedProducts($filters, $order);
        } else {
            $products = $repository->getPaginatedProductsSearch($searchTerm);
        }

        return $this->render('product/index.html.twig', [
            'products' => $products,
            'order' => $order,
            'brand_choice' => $filters['brand'],
            'material_choice' =>  $filters['material'],
            'case_diameter_choice' =>  $filters['case_diameter'],
            'movement_choice' => $filters['movement'],
            'category_choice' => $filters['category'],
        ]);
    }

    #[Route(path: '/{id}/produit', name: 'app_product_show')]
    public function show(Product $product): Response
    {
        return $this->render('product/show.html.twig', [
            'product' => $product,
        ]);
    }
}

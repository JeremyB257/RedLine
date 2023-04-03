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

        $filters = [];
        $filters['brand'] = $request->get('brand') ?? null;
        $filters['material'] = $request->get('material') ?? null;
        $filters['case_diameter'] = $request->get('case_diameter') ?? null;

        $brands = $repository->findDistinctBrand();
        $materials = $repository->findDistinctMaterial();
        $case_diameters = $repository->findDistinctCaseDiameter();
        
        if (!empty($filters)) {
            $products = $repository->findByManyFilters($filters);
            $products = empty($products) ? $repository->findAll() : null;
        } else {
            $products = $repository->findAll();
        };

        return $this->render('product/index.html.twig', [
            'products' => $products,
            'brands' => $brands,
            'materials' => $materials,
            'case_diameters' => $case_diameters,
            'brand_choice' => $filters['brand'],
            'material_choice' =>  $filters['material'],
            'case_diameter_choice' =>  $filters['case_diameter'],
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

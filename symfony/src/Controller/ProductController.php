<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/product', name: 'app_product')]
    public function index(ProductRepository $repository, Request $request): Response
    {

        $filters = [];
        $filters['brand'] = $request->get('brand') ?? null;
        $filters['material'] = $request->get('material') ?? null;
        $filters['case_diameter'] = $request->get('case_diameter') ?? null;

        if (!empty($filters)) {
            $products = $repository->findByManyFilters($filters);
        } else {
            $products = $repository->findAll();
        };

        $brands = $repository->findDistinctBrand();
        $materials = $repository->findDistinctMaterial();
        $case_diameters = $repository->findDistinctCaseDiameter();


        return $this->render('product/index.html.twig', [
            'products' => $products,
            'brands' => $brands,
            'materials' => $materials,
            'case_diameters' => $case_diameters,
        ]);
    }

    #[Route(path: '/{id}/product', name: 'app_product_show')]
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

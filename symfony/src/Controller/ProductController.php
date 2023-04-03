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

        $alert = false;

        if (!empty($filters)) {
           if ($repository->findByManyFilters($filters) == null) {
                $products = $repository->findAll();
                $alert = true;
           } else {
                $products = $repository->findByManyFilters($filters);
           };   
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
            'alert' => $alert,
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

<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\Review;
use App\Form\ReviewType;
use App\Repository\ProductRepository;
use App\Repository\ReviewRepository;
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

        if ($filters['brand'] || $filters['material'] || $filters['case_diameter'] || $filters['movement'] || $filters['category']) {
            $products =  $repository->findByManyFilters($filters);
        } else {
            $products = $repository->findBySearchTerms($searchTerm);
        }

        return $this->render('product/index.html.twig', [
            'products' => $products,
            'brand_choice' => $filters['brand'],
            'material_choice' =>  $filters['material'],
            'case_diameter_choice' =>  $filters['case_diameter'],
            'movement_choice' => $filters['movement'],
            'category_choice' => $filters['category'],
        ]);
    }

    #[Route(path: '/produit/{id}', name: 'app_product_show')]
    public function show(Product $product, ReviewRepository $reviewRepo, Request $request): Response
    {
        //send a review
        $review = new Review;
        $form = $this->createForm(ReviewType::class, $review);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $review->setProduct($product)
                ->setUser($this->getUser());

            $reviewRepo->save($review, true);

            return $this->redirectToRoute('app_product_show', ['id' => $product->getId()]);
        }

        $reviews = $reviewRepo->findBy(['product' => $product], ['createdAt' => 'DESC']);

        //calc review average
        $total = 0;
        $count5 = 0;
        $count4 = 0;
        $count3 = 0;
        $count2 = 0;
        $count1 = 0;

        foreach ($reviews as $key => $review) {
            $total += $review->getEvaluation();
            if ($review->getEvaluation() == 5) $count5 += 1;
            if ($review->getEvaluation() == 4) $count4 += 1;
            if ($review->getEvaluation() == 3) $count3 += 1;
            if ($review->getEvaluation() == 2) $count2 += 1;
            if ($review->getEvaluation() == 1) $count1 += 1;
        }
        $average = $total / count($reviews);
        return $this->render('product/show.html.twig', [
            'product' => $product,
            'reviews' => $reviews,
            'average' => $average,
            'count5' => $count5,
            'count4' => $count4,
            'count3' => $count3,
            'count2' => $count2,
            'count1' => $count1,
            'form' => $form,
        ]);
    }
}

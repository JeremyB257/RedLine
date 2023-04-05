<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\Review;
use App\Form\ReviewType;
use App\Repository\ProductRepository;
use App\Repository\ReviewRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
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

    /**
     * display a product, send a review
     *
     * @param Product $product
     * @param ReviewRepository $reviewRepo
     * @param Request $request
     * @return Response
     */
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
        $average = 0;
        foreach ($reviews as $key => $review) {
            $total += $review->getEvaluation();
            if ($review->getEvaluation() == 5) $count5 += 1;
            if ($review->getEvaluation() == 4) $count4 += 1;
            if ($review->getEvaluation() == 3) $count3 += 1;
            if ($review->getEvaluation() == 2) $count2 += 1;
            if ($review->getEvaluation() == 1) $count1 += 1;
        }
        if ($reviews) $average = $total / count($reviews);
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

    /**
     * remove a review
     *
     * @param Product $product
     * @param Review $review
     * @param ReviewRepository $reviewRepo
     * @return Response
     */
    #[Route(path: '/produit/{idProduct}/{idReview}', name: 'review.delete')]
    #[ParamConverter('product', options: ['mapping' => ['idProduct' => 'id']])]
    #[ParamConverter('review', options: ['mapping' => ['idReview' => 'id']])]
    #[Security("is_granted('ROLE_USER') and user === review.getUser()")]
    public function deleteComment(Product $product, Review $review, ReviewRepository $reviewRepo): Response
    {
        $reviewRepo->remove($review, true);
        return $this->redirectToRoute('app_product_show', ['id' => $product->getId()]);
    }
}

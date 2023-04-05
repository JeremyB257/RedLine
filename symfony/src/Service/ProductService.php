<?php 

namespace App\Service;

use App\Repository\ProductRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class ProductService
{
    public function __construct(
        private RequestStack $requestStack,
        private ProductRepository $productRepository,
        private PaginatorInterface $paginator,
    )
    {
        
    }
    public function getPaginatedProducts($filters)
    {
        $request = $this->requestStack->getMainRequest();
        $page = $request->query->getInt('page', 1);
        $limit = 3;
        $productsQuery = $this->productRepository->findByManyFilters($filters);

        return $this->paginator->paginate($productsQuery, $page, $limit);
    }

    public function getPaginatedProductsSearch($search)
    {
        $request = $this->requestStack->getMainRequest();
        $page = $request->query->getInt('page', 1);
        $limit = 3;
        $productsQuery = $this->productRepository->findBySearchTerms($search);

        return $this->paginator->paginate($productsQuery, $page, $limit);
    }



}
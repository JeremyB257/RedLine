<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use phpDocumentor\Reflection\Types\Void_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    #[Route('/cart', name: 'app_cart')]
    public function index(SessionInterface $session, ProductRepository $productRepository,): Response
    {

        $cart = $session->get('panier', []);

        //ON fabrique les données
        $dataCart = [];
        $total = 0;

        foreach($cart as $id => $quantity){
            $product = $productRepository->find($id);
            $dataCart[] = [
                "product" => $product,
                "quantity" => $quantity,
            ];
            $total += ($product->getPriceHt() * 1.2) * $quantity;
        }

        return $this->render('cart/index.html.twig', compact("dataCart", "total"));
    }

    #[Route('/cart/add/{id}', name: 'app_add')]
    public function add(Product $product, $id, SessionInterface $session)
    {
        // On recupere le panier actuelle
        $cart = $session->get('panier', []);
        $id = $product->getId();

        if (!empty($cart[$id])) {
            $cart[$id]++;
        } else {
            $cart[$id] = 1;
        }

        // on sauvegarde dans la seesion
        $session->set('panier', $cart);

        return $this->redirectToRoute("app_cart");
    }

    #[Route('/cart/remove/{id}', name: 'app_remove')]
    public function remove(Product $product, $id, SessionInterface $session)
    {
        // On recupere le panier actuelle
        
        $cart = $session->get('panier', []);
        $id = $product->getId();

        if (!empty($cart[$id])) {
            if($cart[$id] > 1){
                $cart[$id]--;
            }else{
                unset($cart[$id]);
            }
        }
        // on sauvegarde dans la seesion
        $session->set('panier', $cart);

        return $this->redirectToRoute("app_cart");
    }

    #[Route('/cart/delete/{id}', name: 'app_delete')]
    public function delete(Product $product, $id, SessionInterface $session)
    {
        // On recupere le panier actuelle

        $cart = $session->get('panier', []);
        $id = $product->getId();

        if (!empty($cart[$id])) {
                unset($cart[$id]);
        }
        // on sauvegarde dans la seesion
        $session->set('panier', $cart);

        return $this->redirectToRoute("app_cart");
    }
}

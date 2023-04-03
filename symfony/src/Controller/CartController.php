<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    #[Route('/panier', name: 'cart.index')]
    public function index(SessionInterface $session, ProductRepository $productRepository,): Response
    {

        $cart = $session->get('panier', []);

        //ON fabrique les données
        $dataCart = [];
        $total = 0;
        dump($cart);
        foreach ($cart as $product) {
            $color = $product['color'];
            $quantity = $product['quantity'];
            $product = $productRepository->find($product['id']);
            $dataCart[] = [
                "product" => $product,
                "color" => $color,
                "quantity" => $quantity,
            ];
            $total += ($product->getPriceHt() * 1.2) * $quantity;
        }

        return $this->render('cart/index.html.twig', compact("dataCart", "total"));
    }

    #[Route('/cart/add/{id}', name: 'cart.add')]
    public function add(Int $id, SessionInterface $session, Request $request)
    {
        // On recupere le panier actuelle
        $cart = $session->get('panier', []);
        $color = $request->get('color');

        $handleAdd = 0;
        // if cart is empty = add product
        if (empty($cart)) {
            $cart[] = [
                'id' => $id,
                'color' => $color,
                'quantity' => 1
            ];
            //if cart isn't empty
        } else {
            foreach ($cart as $index => $product) {
                //if product already exist in cart
                if ($product['id'] == $id && $product['color'] == $color) {
                    $cart[$index]['quantity'] = $product['quantity'] + 1;
                    $handleAdd = 1;
                }
            }
            // if product doesn't exist in cart
            if ($handleAdd == 0) {
                $cart[] = [
                    'id' => $id,
                    'color' => $color,
                    'quantity' => 1
                ];
            }
        }

        // on sauvegarde dans la session
        $session->set('panier', $cart);

        return $this->redirectToRoute("cart.index");
    }

    #[Route('/cart/remove/{id}/{color}', name: 'cart.remove')]
    public function remove(Int $id, String $color, SessionInterface $session)
    {
        // On recupere le panier actuelle

        $cart = $session->get('panier', []);
        //@todo a faire
        /* 
        foreach ($cart as $index => $product) {
            if ($product['id'] == $id && $product['color'] == $color) {
                unset($cart[$index]);
            }
        } */
        // on sauvegarde dans la seesion
        $session->set('panier', $cart);

        return $this->redirectToRoute("cart.index");
    }

    #[Route('/cart/delete/{id}/{color}', name: 'cart.delete')]
    public function delete(Int $id, String $color, SessionInterface $session)
    {
        // On recupere le panier actuelle
        $cart = $session->get('panier', []);

        foreach ($cart as $index => $product) {
            if ($product['id'] == $id && $product['color'] == $color) {
                unset($cart[$index]);
            }
        }
        // on sauvegarde dans la seesion
        $session->set('panier', $cart);

        return $this->redirectToRoute("cart.index");
    }
}

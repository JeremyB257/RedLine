<?php

namespace App\Controller;

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
        // Get cart from session
        $cart = $session->get('panier', []);

        $dataCart = [];
        $total = 0;
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
        // Get cart from session
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

        // Save cart on session
        $session->set('panier', $cart);

        return $this->redirectToRoute("cart.index");
    }

    #[Route('/cart/remove/{id}/{color}', name: 'cart.remove')]
    public function remove(Int $id, String $color, SessionInterface $session)
    {
        // Get cart from session
        $cart = $session->get('panier', []);

        foreach ($cart as $index => $product) {
            if ($product['id'] == $id && $product['color'] == $color) {
                if ($product['quantity'] > 1) {
                    $cart[$index]['quantity'] = $product['quantity'] - 1;
                } else {
                    unset($cart[$index]);
                }
            }
        }
        // Save cart on session
        $session->set('panier', $cart);

        return $this->redirectToRoute("cart.index");
    }

    #[Route('/cart/delete/{id}/{color}', name: 'cart.delete')]
    public function delete(Int $id, String $color, SessionInterface $session)
    {
        // Get cart from session
        $cart = $session->get('panier', []);

        foreach ($cart as $index => $product) {
            if ($product['id'] == $id && $product['color'] == $color) {
                unset($cart[$index]);
            }
        }
        // Save cart on session
        $session->set('panier', $cart);

        return $this->redirectToRoute("cart.index");
    }
}

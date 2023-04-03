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
    #[Route('/panier', name: 'app_cart')]
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

    #[Route('/cart/add', name: 'app_add')]
    public function add(SessionInterface $session, Request $request)
    {
        // On recupere le panier actuelle
        $cart = $session->get('panier', []);
        $id = $request->get('product');
        $color = $request->get('color');


        // if cart is empty = add product
        if (empty($cart)) {
            $cart[] = [
                'id' => $id,
                'color' => $color,
                'quantity' => 1
            ];
            //if cart isn't empty
        } else {
            foreach ($cart as $product) {
                //if product already exist in cart
                if ($product['id'] == $id && $product['color'] == $color) {
                    $product['quantity'] = $product['quantity'] + 1;
                    dd($product);
                    break;
                }
            }
            // if product doesn't exist in cart
            $cart[] = [
                'id' => $id,
                'color' => $color,
                'quantity' => 1
            ];
        }



        // on sauvegarde dans la session
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
            if ($cart[$id] > 1) {
                $cart[$id]--;
            } else {
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

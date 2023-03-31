<?php

namespace App\Controller;

use App\Entity\Product;
use phpDocumentor\Reflection\Types\Void_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    #[Route('/cart', name: 'app_cart')]
    public function index(): Response
    {
        return $this->render('cart/index.html.twig', [
            
        ]);
    }
    #[Route('/cart/add/{id}', name: 'app_add')]
    public function add(Product $product, $id, SessionInterface $session)
    {
        // On recupere le pa,ier actuelle
        $panier = $session->get('panier', []);
        $id = $product->getId();

        if(!empty($panier[$id])){
            $panier[$id]++;
        }else{
            $panier[$id] = 1;
        }

        // on sauvegarde dans la seesion
        $session->set('panier', $panier);

        return $this->redirectToRoute("app_cart");
    }
}

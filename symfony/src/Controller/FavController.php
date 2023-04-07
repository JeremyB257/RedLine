<?php

namespace App\Controller;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FavController extends AbstractController
{
    #[Route('/fav/{id}/produit', name: 'fav.product')]
    public function index(Product $product, EntityManagerInterface $manager): Response
    {
        $user = $this->getUser();

        if ($product->isFavByUser($user)) {
            $product->removeFavorite($user);
            $manager->flush();

            return $this->json(['message' => 'Le produit ne fait plus partie des favoris.']);
        } else {
            $product->addFavorite($user);
            $manager->flush();
            return $this->json(['message' => 'Le produit a été ajouté aux favoris.']);
        };

        return $this->render('fav/index.html.twig', [
            'controller_name' => 'FavController',
        ]);
    }
}

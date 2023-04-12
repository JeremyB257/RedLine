<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FavController extends AbstractController
{
    #[Route(path: '/fav/{id}/produit', name: 'fav.product')]
    #[Security("is_granted('ROLE_USER') and user === currentUser")]
    public function favoriteFeature(Product $product, EntityManagerInterface $manager): Response
    {
        $currentUser = $this->getUser();

        if ($product->isFavByUser($currentUser)) {
            $product->removeFavorite($currentUser);
            $manager->flush();

            return $this->json(['message' => 'Le produit ne fait plus partie des favoris.']);
        } else {
            $product->addFavorite($currentUser);
            $manager->flush();
            return $this->json(['message' => 'Le produit a été ajouté aux favoris.']);
        };

        return $this->render('fav/index.html.twig', [
            'controller_name' => 'FavController',
        ]);
    }

    #[Route(path: '/{id}/unfav', name: 'unfav.product')]
    #[Security("is_granted('ROLE_USER') and user === currentUser")]
    public function removeFav(Product $product, EntityManagerInterface $manager): Response
    {
        $currentUser = $this->getUser();

        if ($product->isFavByUser($currentUser)) {
            $product->removeFavorite($currentUser);
            $manager->flush();

            return $this->json(['message' => 'Le produit ne fait plus partie des favoris.']);
        };

        return $this->render('fav/index.html.twig', [
            'controller_name' => 'FavController',
        ]);
    }

    #[Route(path: '/{id}/mes-favoris', name: 'fav.list')]
    #[Security("is_granted('ROLE_USER') and user === currentUser")]
    public function index($id, User $currentUser): Response
    {
        $favs = $currentUser->getFavorite();

        return $this->render('fav/favorites.html.twig', [
            'favs' => $favs,
        ]);
    }

}

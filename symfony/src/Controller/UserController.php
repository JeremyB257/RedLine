<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/utilisateur/{id}', name: 'app_user')]
    #[Security("is_granted('ROLE_USER') and user === currentUser")]
    public function index(User $currentUser): Response
    {
        return $this->render('user/index.html.twig', [
            'user' => $currentUser,
        ]);
    }


    #[Route('/utilisateur/{id}/mot-de-passe', name: 'user.password')]
    #[Security("is_granted('ROLE_USER') and user === currentUser")]
    public function changePassword(User $currentUser): Response
    {

        return $this->render('user/password.html.twig', [
            'user' => $currentUser,
        ]);
    }
}

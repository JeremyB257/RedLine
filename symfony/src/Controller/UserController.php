<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class UserController extends AbstractController
{
    #[Route('/user/{firstname}', name: 'app_user')]
    // #[IsGranted('ROLE_USER')]
    public function index(User $user, HttpFoundationRequest $request, UserRepository $userRepository ): Response
    {

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->save($user, true);

            return $this->redirectToRoute('app_user', ['firstname' => $user->getfirstname()], Response::HTTP_SEE_OTHER);
        }
        return $this->render('user/index.html.twig', [
            'user'=> $user,
            'accountForm' => $form,
        ]);
    }
}

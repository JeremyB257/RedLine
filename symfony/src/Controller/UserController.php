<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/utilisateur/{id}', name: 'app_user')]
    #[Security("is_granted('ROLE_USER') and user === currentUser")]
    public function index(User $currentUser, HttpFoundationRequest $request, UserRepository $userRepository): Response
    {

        $form = $this->createForm(UserType::class, $currentUser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->save($currentUser, true);

            return $this->redirectToRoute('app_user', ['id' => $currentUser->getid()], Response::HTTP_SEE_OTHER);
        }
        return $this->render('user/index.html.twig', [
            'user' => $currentUser,
            'accountForm' => $form,
        ]);
    }
}

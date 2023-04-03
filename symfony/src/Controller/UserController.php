<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\PasswordType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
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
    public function changePassword(User $currentUser, Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $manager): Response
    {

        $form = $this->createForm(PasswordType::class, $currentUser);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $currentUser->setPassword($userPasswordHasher->hashPassword(
                $currentUser,
                $form->get('plainPassword')->getData()
            ));
            $manager->persist($currentUser);
            $manager->flush();

            $this->addFlash('success', 'Votre mot de passe a bien été changé');
        }


        return $this->render('user/password.html.twig', [
            'user' => $currentUser,
            'form' => $form
        ]);
    }
}

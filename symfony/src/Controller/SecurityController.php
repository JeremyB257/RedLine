<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Repository\UserRepository;
use App\Security\AppAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;

class SecurityController extends AbstractController
{
    #[Route(path: '/connexion', name: 'app_login')]
    public function login(
        AuthenticationUtils $authenticationUtils,
        Request $request,
        UserPasswordHasherInterface $userPasswordHasher,
        UserRepository $userRepository,
        UserAuthenticatorInterface $userAuthenticator,
        AppAuthenticator $authenticator,
        EntityManagerInterface $entityManager
    ): Response {

        //Security Controller de Base
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        // Importation du code RegistrationController
        $user = new User();
        $registerForm = $this->createForm(RegistrationFormType::class, $user, [
            'validation_groups' => ['registration'],
        ]);
        $registerForm->handleRequest($request);



        if ($registerForm->isSubmitted() && $registerForm->isValid()) {
            // encode the plain password
            $userDisable = $userRepository->findOneBy(["email" => $user->getEmail()]);
            if ($userDisable) {
                if ($userPasswordHasher->isPasswordValid(
                    $userDisable,
                    $registerForm->get('plainPassword')->getData()
                )) {
                    $user = $userDisable;
                    $user->setActive(true);
                } else {
                    $this->addFlash('danger', 'Le mot de passe ne correspond pas avec le compte relié, veuillez saisir votre mot de passe d\'origine');
                    return $this->redirectToRoute('app_login');
                }
            } else {
                $user->setActive(true);
                $user->setPassword(
                    $userPasswordHasher->hashPassword(
                        $user,
                        $registerForm->get('plainPassword')->getData()
                    )
                );
            }

            $entityManager->persist($user);
            $entityManager->flush();

            return $userAuthenticator->authenticateUser(
                $user,
                $authenticator,
                $request,
            );
        }

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
            'registrationForm' => $registerForm->createView(),
        ]);
    }

    #[Route(path: '/déconnexion', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}

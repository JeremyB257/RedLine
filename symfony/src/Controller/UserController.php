<?php

namespace App\Controller;

use App\Entity\User;

use App\Form\UserType;
use App\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Form\PasswordType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * display information form
     *
     * @param User $currentUser
     * @param Request $request
     * @param UserRepository $userRepository
     * @return Response
     */
    #[Route('/utilisateur/{id}', name: 'app_user')]
    #[Security("is_granted('ROLE_USER') and user === currentUser")]
    public function index(User $currentUser, Request $request, UserRepository $userRepository): Response
    {

        $form = $this->createForm(UserType::class, $currentUser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->save($currentUser, true);

            return $this->redirectToRoute('app_user', ['id' => $currentUser->getid()], Response::HTTP_SEE_OTHER);
        }

        $delete = $request->get('delete');

        if ($delete) {
            /** @var \App\Entity\User $user */
            $user = $this->getUser();
            $user->setActive(false);

            $userRepository->save($user, true);

            return $this->redirectToRoute('app_logout');
        }

        return $this->render('user/index.html.twig', [
            'user' => $currentUser,
            'accountForm' => $form,
        ]);
    }


    /**
     * Change password
     *
     * @param User $currentUser
     * @param Request $request
     * @param UserPasswordHasherInterface $userPasswordHasher
     * @param EntityManagerInterface $manager
     * @return Response
     */
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
